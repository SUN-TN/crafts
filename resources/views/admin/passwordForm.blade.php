@extends('admin.layout.master')

@section('content')
    <div class="passwordPanel">
        <h1>修改密码</h1>
        <el-form label-position="right" label-width="80px" method="post" action="" >
            {{csrf_field()}}
            <el-form-item label="原密码" class="lab">
                <el-input class="inp" name="original_password"  v-model="pw.original_password" show-password></el-input>
            </el-form-item>
            <el-form-item label="新密码" class="lab">
                <el-input class="inp" name="password" v-model="pw.password" show-password></el-input>
            </el-form-item>
            <el-form-item label="确认密码" class="lab">
                <el-input class="inp" name="password_confirmation" v-model="pw.password_confirmation" show-password></el-input>
            </el-form-item>
            <el-button type="primary" native-type="submit" class="btn_sub">提交</el-button>
        </el-form>
    </div>
@endsection

@section('js_css')
    <script>
        var app = new Vue({
            el: '#app',
            data() {
                return {
                    el_menu: {
                        openIndex: '0',
                        active:'0',
                    },
                    pw:{
                        original_password:'',
                        password:'',
                        password_confirmation:'',
                    }
                };
            },
            mounted() {
                let message = '';
                @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            message = message + '<div>' +('{{$error}}') + '</div><br>';
                        @endforeach
                    this.$message.error({
                    dangerouslyUseHTMLString: true,
                    message: message.substr(0,message.length-4),
                });
                @endif
            }

        })
    </script>

    <style>
        .passwordPanel {
            position: relative;
            width: 500px;
            height: 400px;
            border-radius: 25px;
            background-color: rgb(245, 245, 245);
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        h1 {
            width: 200px;
            margin: 0 auto;
            text-align: center;
            color: rgb(45, 142, 247);
            font-size: 2em;
            padding-top: 10px;
        }

        .el-form {
            position: absolute;
            margin-left: 25px;
            margin-top: 50px;
        }

        .el-form-item__label {
            color: rgb(45, 142, 247);
        }

        .inp {
            width: 350px;
        }

        .btn_sub {
            margin-left: 45%;
        }
    </style>
@endsection