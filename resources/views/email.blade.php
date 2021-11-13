<b style="color: #1F8342"> {{__('message.TourName')}} : </b>
<b> {{ $reserve->tour_header }} </b> <br>
<b style="color: #1F8342"> {{ __('message.TourDate') }} : </b>
<b> {{ $reserve->tour_date }} </b> <br>
<b style="color: #1F8342"> {{ __('message.PlacePick') }} : </b>
<b> {{ $reserve->pick_up_place }} </b> <br>
<b style="color: #1F8342"> {{ __('message.RoomNumber') }} : </b>
<b>  {{ $reserve->room_number }} </b> <br>
<b style="color: #1F8342"> {{  __('message.adult') }} : </b>
<b>  {{ $reserve->adult }} </b> <br>
<b style="color: #1F8342"> {{ __('message.child') }} : </b>
<b>  {{ $reserve->child }} </b> <br>
<b style="color: #1F8342"> {{ __('message.infants') }} : </b>
<b>  {{ $reserve->infant }} </b> <br>
<b style="color: #1F8342"> {{ __('message.YourMessage') }} : </b>
<b>  {{ $reserve->message }} </b><br>
<b style="color: #1F8342"> {{ __('message.YourName') }} : </b>
<b>  {{ $reserve->name }} </b><br>
<b style="color: #1F8342"> {{ __('message.YourEmail') }} : </b>
<b>  {{ $reserve->email }} </b><br>
<b style="color: #1F8342"> {{ __('message.YourPhone') }} : </b>
<b> {{  $reserve->phone }} </b><br>
<b style="color: #1F8342"> {{  __('message.ReservationDate') }} : </b>
<b>  {{ date('Y-m-d H:i:s') }} </b><br>
