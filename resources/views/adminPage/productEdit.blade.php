{{-- @extends('masterAP')
@section('contentAP') --}}

<div class="my-dropzone"><input type="text"></div>

<script>
    // Dropzone has been added as a global variable.
const dropzone = new Dropzone("div.my-dropzone", { url: "/file/post" });
</script>

{{-- @endsection --}}