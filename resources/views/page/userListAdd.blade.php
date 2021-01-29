@include('include.header')
@php
if(old('firstName')){
    $first = old('firstName');
    $last = old('lastName');
    $phone = old('phone');
}
else if(isset($data) && $data){
    $first = $data->details->first_name;
    $last = $data->details->last_name;
    $phone = $data->details->phone_number;
}
else{
    $first = null;
    $last = null;
    $phone = null;

}
@endphp

<form action="{{$action}}">
    {{csrf_field()}}
    <div class="form-group">
        <label for="firstName">First name</label>
        <input type="text" id="firstName" name="firstName" class="form-control" value="{{$first}}" placeholder="Enter First Name">
    </div>
    <div class="form-group">
        <label for="lastName">Last name</label>
        <input type="text" id="lastName" name="lastName" class="form-control" value="{{$last}}" placeholder="Enter Last Name">
    </div>
    <div class="form-group">
        <label for="phones">Phone Number</label>
        <input type="tel" id="phone" name="phone" class="form-control" value="{{$phone}}" placeholder="Enter Phone Number">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    $("#phone").on("keypress keyup blur",function (event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

</script>
