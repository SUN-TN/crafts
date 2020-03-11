<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>后台管理</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{asset('/js/vue.js')}}"></script>
    <script src="{{asset('/elementUI/index.js')}}"></script>
    <script src="{{asset('/js/axios.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/elementUI/index.css')}}">
</head>

<body>

<div id="app">
    <el-header class="header">
        <span class="icon">后台管理</span>
        <el-dropdown class="adminPanel">
                    <span class="el-dropdown-link">
                        {{Auth::guard('admin')->user()->username}}
                        <i class="el-icon-arrow-down el-icon--right"></i>
                    </span>
            <el-dropdown-menu slot="dropdown">
                <a href="/admin/changePassword">
                    <el-dropdown-item>修改密码</el-dropdown-item>
                </a>
                <a href="/admin/logout">
                    <el-dropdown-item>退出</el-dropdown-item>
                </a>
            </el-dropdown-menu>
        </el-dropdown>
    </el-header>

    <el-row class="mainPanel">
        <el-col :span="4" class="aside">
            <el-menu class="el-menu-vertical-demo" text-color="black" :unique-opened="true"
                     :default-openeds="[el_menu.openIndex]" :default-active="el_menu.active">

                <el-submenu index="1">
                    <template slot="title">
                        <i class="el-icon-menu"></i>
                        <span>商品管理</span>
                    </template>
                    <a href="/admin/goods">
                        <el-menu-item index="1-1">商品信息管理</el-menu-item>
                    </a>
                    <a href="/admin/genres">
                        <el-menu-item index="1-2">商品类型管理</el-menu-item>
                    </a>
                </el-submenu>


                <el-submenu index="2">
                    <template slot="title">
                        <i class="el-icon-menu"></i>
                        <span>用户管理</span>
                    </template>
                    <a href="/admin/user">
                        <el-menu-item index="2-1">查看用户信息</el-menu-item>
                    </a>
                    <a href="/admin/add">
                        <el-menu-item index="2-2">添加管理员</el-menu-item>
                    </a>
                </el-submenu>


                <el-submenu index="3">
                    <template slot="title">
                        <i class="el-icon-menu"></i>
                        <span style="color: black;">申请审核管理</span>
                    </template>
                    <a href="/admin/goods_audit">
                        <el-menu-item index="3-1">商品上架审核</el-menu-item>
                    </a>
                    <a href="/admin/seller_audit">
                        <el-menu-item index="3-2">成为商家申请审核</el-menu-item>
                    </a>
                </el-submenu>
            </el-menu>
        </el-col>

        <el-col :span="20" class="main">
            <el-row style="height: 100%">
                <el-col :span="23" :offset="1"  style="background-color: white;height: 100%;">
                    @yield('content')
                </el-col>
            </el-row>
        </el-col>
    </el-row>
</div>

<script>
    // var app = new Vue({
    //     el: '#app',
    //     data() {
    //         return {
    //             el_menu: {
    //                 openIndex: '1',
    //                 active: '1-1',
    //             },
    //             genres: [],
    //         };
    //     }
    // })
</script>
<style>
    html,
    body {
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
        background-color:  whitesmoke;
    }

    a {
        text-decoration: none;
    }

    .header {
        line-height: 50px;
        position: fixed;
        height: 50px;
        width: 100%;
        top: 0px;
        left: 0;
        background-color: white;
    }

    .icon{
        font-size: 1.8em;
    }
    .adminPanel {
        padding-top: 5px;
        float: right;
    }
    .mainPanel {
        position: fixed;
        top: 75px;
        width: 100%;
        height: 100%;
        background-color: whitesmoke;
    }

    .aside {
        height: 100%;
        background-color: white;
    }

    .main {
        background-color:whitesmoke;
        height: 100%;
        max-height: 100%;
        overflow: auto;
    }

    .el-menu {
        border-right: none;
        background-color: white;
    }


</style>

@yield('js_css')

</body>

</html>