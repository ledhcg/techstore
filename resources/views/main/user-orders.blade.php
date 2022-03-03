@extends('layouts.main-user-layout')

@section('title')
    <title>TECHSTORE</title>
@endsection

@section('content')
    <!-- Orders list-->
    <div class="table-responsive fs-md mb-4">
        <table class="table table-hover mb-0">
            <thead>
            <tr>
                <th>{{__('main.Order ID')}}</th>
                <th>{{__('main.Date Purchased')}}</th>
                <th>{{__('main.Status')}}</th>
                <th>{{__('main.Total')}}</th>
            </tr>
            </thead>
            <tbody>
            @if($result)
                @foreach($dataOrders as $order)
                <tr>
                    <td class="py-3"><a class="nav-link-style fw-medium fs-sm" href="{{route('main.orderTracking', $order->order_tracking)}}" target="_blank">{{$order->order_tracking}}</a></td>
                    <td class="py-3">{{date('g:i A, d M Y', strtotime($order->created_at))}}</td>
                    <td class="py-3"><span class="badge
                            @if($order->order_status == 'CREATED')
                            bg-warning
                            @elseif($order->order_status == 'RECEIVED')
                            bg-info
                            @elseif($order->order_status == 'DELIVERING')
                            bg-primary
                            @elseif($order->order_status == 'DELIVERED')
                            bg-success
                            @elseif($order->order_status == 'DELETE')
                            bg-dark
                            @endif
                    m-0">{{$order->order_status}}</span></td>
                    <td class="py-3">{{number_format($order->order_total, 1, ',', ' ')}} ₽</td>
                </tr>
                @endforeach
            @else
                <tr >
                    <td colspan="4" align="center">
                        {{__('main.Empty')}}
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <!-- Pagination-->
    <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
        @if ($dataOrders->lastPage() > 1)
        <ul class="pagination">
            <li class="page-item {{ ($dataOrders->currentPage() == 1) ? ' disabled' : '' }}"><a class="page-link" href="{{ $dataOrders->url(1) }}"><i class="ci-arrow-left me-2"></i>Prev</a></li>
        </ul>
        <ul class="pagination">
            <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
            @for ($i = 1; $i <= $dataOrders->lastPage(); $i++)
                @if($dataOrders->currentPage() == $i)
                    <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">{{$i}}<span class="visually-hidden">(current)</span></span></li>
                @else
                    <li class="page-item d-none d-sm-block"><a class="page-link" href="{{$dataOrders->url($i)}}">{{$i}}</a></li>
                @endif
            @endfor
        </ul>
        <ul class="pagination">
            <li class="page-item {{ ($dataOrders->currentPage() == $dataOrders->lastPage()) ? ' disabled' : '' }}"><a class="page-link" href="{{ $dataOrders->url($dataOrders->currentPage()+1) }}" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>
        </ul>
        @endif
    </nav>
@endsection
@section('script')
    <script>

    </script>

@endsection
