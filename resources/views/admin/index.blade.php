@extends('admin.layout.master')
@section('content')
    <div id="content">
    </div>
@endsection

@section('js_css')
    <script>
        var app = new Vue({
            el: '#app',
            data() {
                return {
                    el_menu: {
                        openIndex: '1',
                        active: '1-1',
                    },
                    genres: [],
                };
            }
        })
    </script>

    <style>
        #content{
            width: 100%;
        }
    </style>
@endsection

