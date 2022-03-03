@extends('layouts.main-user-layout')

@section('title')
    <title>TECHSTORE</title>
@endsection

@section('content')
    <div class="page-notifications">
    @forelse($notifications as $notification)
        @if($loop->first)
            <div class="pb-4">
                <button type="button" class="btn btn-outline-primary p-6 right" onclick="markAllAsRead()">
                    <i class="ci-check me-2"></i>
                    {{__('main.Mark all as read')}}
                </button>
            </div>
        @endif

        @if($notification->unread())
        <div class="alert alert-dark" role="alert">
            <div class="d-flex p-2 px-2 pt-2 pb-2">
                <i class="ci-loudspeaker fs-lg mt-2 mb-0 text-primary"></i>
                <div class="ps-3">
                    <span class="fs-ms text-muted">{{$notification->created_at}}</span>
                    <a class="d-block fs-sm pointer text-light" data-id="{{$notification->id}}" data-order_tracking="{{$notification->data['order_tracking']}}" onclick="goToOrderTracking(this)">[<strong>{{$notification->data['order_tracking']}}</strong>] - {{__('main.Order status has been changed')}}</a>
                </div>
            </div>
        </div>
        @else
            <div class="alert alert-primary" role="alert">
                <div class="d-flex p-2 px-2 pt-2 pb-2">
                    <i class="ci-loudspeaker fs-lg mt-2 mb-0 text-primary"></i>
                    <div class="ps-3">
                        <span class="fs-ms text-muted">{{$notification->created_at}}</span>
                        <a class="d-block fs-sm pointer text-heading" data-id="{{$notification->id}}" data-order_tracking="{{$notification->data['order_tracking']}}" onclick="goToOrderTracking(this)">[<strong>{{$notification->data['order_tracking']}}</strong>] - {{__('main.Order status has been changed')}}</a>
                    </div>
                </div>
            </div>
        @endif

    @empty
        <div class="text-center pt-3">
            <h2 class="h6">{{__('main.Empty list')}}</h2>
        </div>
    @endforelse
    </div>
@endsection
@section('script')
    <script>
        function reloadNotification(){
            var url = '{{ route("main.getUserNotifications") }}';
            $.ajax({
                type:'GET',
                url:url,
                success:function(data){
                    var data_convert = jQuery.parseJSON(JSON.stringify(data));

                    if(data_convert.count == 0){
                        $('.page-notifications').html(
                            `<div class="text-center pt-3">
                                <h2 class="h6">{{__('main.Empty list')}}</h2>
                             </div>`
                        )
                    } else {
                        var html_list_notifications = `
                        <div class="pb-4">
                            <button type="button" class="btn btn-outline-primary p-6 right" onclick="markAllAsRead()">
                                <i class="ci-check me-2"></i>
                                {{__('main.Mark all as read')}}
                            </button>
                        </div>
                        `;

                        data_convert.notifications.forEach(noti => {
                            if(noti.read_at == null){
                                html_list_notifications +=  `<div class="alert alert-dark" role="alert">
                                    <div class="d-flex p-2 px-2 pt-2 pb-2">
                                        <i class="ci-loudspeaker fs-lg mt-2 mb-0 text-primary"></i>
                                        <div class="ps-3">
                                            <span class="fs-ms text-muted">`+ new Date(noti.created_at).toLocaleString() +`</span>
                                            <a class="d-block fs-sm pointer text-light" data-id="`+ noti.id +`" data-order_tracking="`+ noti.data.order_tracking +`" onclick="goToOrderTracking(this)">[<strong>`+ noti.data.order_tracking +`</strong>] - {{__('main.Order status has been changed')}}</a>
                                        </div>
                                    </div>
                                </div>`
                                ;
                            } else {
                                html_list_notifications +=  `<div class="alert alert-primary" role="alert" id="item-notify-`+ noti.id +`">
                                    <div class="d-flex p-2 px-2 pt-2 pb-2">
                                        <i class="ci-loudspeaker fs-lg mt-2 mb-0 text-primary"></i>
                                        <div class="ps-3">
                                            <span class="fs-ms text-muted">`+ new Date(noti.created_at).toLocaleString() +`</span>
                                            <a class="d-block fs-sm pointer text-heading" data-id="`+ noti.id +`" data-order_tracking="`+ noti.data.order_tracking +`" onclick="goToOrderTracking(this)">[<strong>`+ noti.data.order_tracking +`</strong>] - {{__('main.Order status has been changed')}}</a>
                                        </div>
                                    </div>
                                </div>`
                                ;
                            }
                        });
                        $('.page-notifications').html(html_list_notifications);
                    }
                }
            });
        }
        function markAllAsRead(){
            var url = '{{route('notification.markAllAsReadNotificationsUser')}}';
            $.ajax({
                type:'POST',
                url:url,
                data: {
                    _token: '{{csrf_token()}}'
                },
                success:function(data){
                    if(data.success == 1){
                        reloadNotificationNavbar();
                        if(typeof reloadNotification === "function"){
                            reloadNotification();
                        }
                    }
                }
            });
        }
    </script>
@endsection
