<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function delivery(){
        // Данные заказа:
        $order = array(
            'id'            => 123456,
            'name'          => 'Иван Петров',
            'address'       => 'г.Москва, ул.Тверская, д.23',
            'phone'         => '+7 (905) 123-45-67',
            'comment'       => '3й этаж',
            'delivery_date' => '17.09.2021 10:00',
        );

        // Заказанные продукты:
        $prods = array(
            array(
                'id'      => 1,
                'name'    => 'Сок',
                'price'   => 100.0,
                'count'   => 1,
            ),
            array(
                'id'      => 2,
                'name'    => 'Маффин',
                'price'   => 200.0,
                'count'   => 2,
            )
        );
        // Получаем координаты адреса доставки:
        $ch = curl_init('https://geocode-maps.yandex.ru/1.x/?apikey='.config('app.YANDEX_MAP_JS_API').'&format=json&geocode=' . urlencode($order['address']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($res, true);
        $coordinates = explode(' ', $res['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']);
        foreach($coordinates as $i => $r) {
            $coordinates[$i] = floatval($r);
        }
        $coordinates = array_shift($coordinates);

        // Приводим телефон к формату +7XXXXXXXXXX
        $phone = preg_replace('/[\s]/', '', $order['phone']);
        $phone = preg_replace('/[^0-9\+]/', '', $phone);
        $phone = ltrim($phone, '+');
        $phone = '+' . $phone;

        // Формируем массив продуктов в заказе
        $items = array();
        foreach ($prods as $row) {
            $items[] = array(
                "cost_currency" => 'RUB',
                "cost_value"    => $row['price'],
                "pickup_point"  => 1,
                "droppof_point" => 2,
                "fiscalization" => array(
                    "article"   => $row['id'],
                    "item_type" => 'product',
                ),
                "quantity" => $row['count'],
                "title"    => $row['name'],
            );
        }

        // Формируем общий массив
        $data = array(
            "callback_properties" => array(
                "callback_url" => 'https://example.com/?', // URL, будет вызываться при смене статусов.
            ),
            "client_requirements" => array(
                "cargo_loaders" => 0,
                "pro_courier"   => false,
                "taxi_class"    => 'courier' // Класс такси. Значения: courier, express, cargo
            ),
            "comment" => $order['comment'],
            "due" => date('c', $order['delivery_date']),
            "emergency_contact" => array(
                "name"  => $order['name'],
                "phone" => $phone
            ),
            "items" => $items,
            "optional_return" => false,
            "referral_source" => 'Источник заявки (можно передать наименование CMS)',
            "route_points" => array(
                // Откуда забрать заказ (точка А)
                array(
                    "address" => array(
                        "coordinates" => array(35.534901, 55.734963),
                        "fullname"    => 'г. Москва, .....',
                    ),
                    "contact" => array(
                        "email" => '',
                        "name"  => '',
                        "phone" => ''
                    ),
                    'point_id' => 1,
                    'skip_confirmation' => true,
                    'type' => 'source',
                    'visit_order' => 1,
                ),
                // Куда доставить заказ (точка Б)
                array(
                    "address" => array(
                        "coordinates" => $coordinates,
                        "fullname"    => $order['address'],
                    ),
                    "contact" => array(
                        "email" => '',
                        "name"  => '',
                        "phone" => ''
                    ),
                    'point_id' => 2,
                    'skip_confirmation' => true,
                    'type' => 'destination',
                    'visit_order' => 2,
                ),
            ),
            "shipping_document" => '',
            "skip_act" => true,
            "skip_client_notify" => false,
            "skip_door_to_door" => false,
            "skip_emergency_notify" => false
        );

        // Отправка:
        $gen_uuid = gen_uuid();
        $ch = curl_init('https://b2b.taxi.yandex.net/b2b/cargo/integration/v2/claims/create?request_id=' . $gen_uuid);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: ru', 'Authorization: Bearer '.config('app.YANDEX_DELIVERY_TOKEN').''));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        // Читаем ответ
        $res = json_decode($res, true);
        if (!empty($res['id'])) {
            //var_dump($res);
            echo '№ заказа: ' . $res['id'];
        } else {
            echo $res['message'];
        }
    }

    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}
