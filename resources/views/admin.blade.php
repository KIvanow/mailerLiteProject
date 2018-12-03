@extends('layouts.app')

@push('scripts')
{{-- <script src="{{ asset('js/regularUser.js')}}" defer></script> --}}
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Subscribers</div>

                <table id="adminSubscriberTable">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="alignCenter">Delete</th>
                    </tr>
                </table>
            </div>
            <add-subscriber-form :userid="'{!! json_encode(Auth::user()->id) !!}'"></add-subscriber-form>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', ()=>{
        displayAllSubscribers({!! Auth::user()->id !!});
    }, false);
</script>
