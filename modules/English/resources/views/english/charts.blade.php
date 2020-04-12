@extends('en::layouts.app')
@section('content')

    <div class="row">
        <h1>{{config('app.name')}} English</h1>
        <p class="text-info"><b>Hãy học tập để vươn tầm, kết nối với hàng tỉ người trên thế giới.
                Vượt ra khỏi giới hạn ao làng, vốn kiến thức hạn hẹp của tiếng mẹ đẻ,
                tiếp xúc với thông tin đa chiều của đa quốc gia, lĩnh hội kiến thức toàn cầu. </b></p>
        @if(!auth()->check())
            <p class="text-success"><i>Hãy đăng nhập để lưu lại chiến tích chăm chỉ học tập của bạn. </i></p>
        @endif
    </div>

    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="panel-title">Crazy</div>
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush