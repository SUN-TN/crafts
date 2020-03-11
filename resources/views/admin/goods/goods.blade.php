@extends('admin.layout.master')

@section('content')
    <section id="content">
        <el-row class="topBox">
            <el-col :md="3" :sm="3" :xs="3">
                <p class="title">商品列表</p>
            </el-col>
            <el-col :sm="12" :xs="12" :md="12" :offset="3">
                <el-row>
                    <el-col :sm="14" :xs="14" :md="14">
                        <el-input></el-input>
                    </el-col>
                    <el-col :sm="5" :xs="5" :md="5" :offset="1">
                        <el-button type="primary" icon="el-icon-search">搜索</el-button>
                    </el-col>
                </el-row>
            </el-col>
            <el-col :md="2" :sm="2" :xs="2" :offset="4">
                <el-button type="primary" class="btn_add" @click="addDialogVisible = true">添加商品</el-button>
            </el-col>
        </el-row>

        <el-row class="list">
            <el-col :md="24" :sm="24" :xs="24">
                <el-table style="width: 100%" height="80%" :data="goods">
                    <el-table-column label="编号" width="100">
                        <template slot-scope="scope">
                            <span style="margin-left: 10px">@{{ scope.$index+1 }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="名称" width="200">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.name }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="作者" width="100">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.author }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="类型" width="100">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.genre }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="简介" width="400">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.intro }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="尺寸" width="100">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.size }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="价格" width="100">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.price }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="收藏量" width="100">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.stras }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="操作">
                        <template slot-scope="scope">
                            <el-button size="mini" v-on:click="handleEdit(scope.$index, scope.row)">编辑
                            </el-button>

                            <el-button size="mini" type="danger" slot="reference"
                                       v-on:click="handleDelete(scope.$index, scope.row)">删除
                            </el-button>
                        </template>
                    </el-table-column>

                </el-table>
            </el-col>
        </el-row>

        <el-row class="paging">
            <el-col :xs="12" :sm="12" :md="12">
                <el-pagination background layout="prev, pager, next" :total="1000">
                </el-pagination>
            </el-col>
            <el-col :xs="12" :sm="12" :md="12"></el-col>
        </el-row>


        <el-dialog title="添加商品" :visible="addDialogVisible" width="30%" :show-close="false"
                   :modal-append-to-body='false'>
            <el-form label-position="right" label-width="80px" :model="addGoods">

                <el-form-item label="名称">
                    <el-input v-model="addGoods.name"></el-input>
                </el-form-item>
                <el-form-item label="作者">
                    <el-input v-model="addGoods.author"></el-input>
                </el-form-item>
                <el-form-item label="类型">
                    <el-select v-model="genre" placeholder="请选择分类" style="width: 100%">
                        <el-option
                                v-for="item in genres"
                                :key="item.id"
                                :label="item.genre"
                                :value="item.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="尺寸">
                    <el-input v-model="addGoods.size"></el-input>
                </el-form-item>
                <el-form-item label="价格">
                    <el-input v-model="addGoods.price"></el-input>
                </el-form-item>
                <el-form-item label="商家">
                    <el-select v-model="genre" placeholder="请选择商品所属商家" style="width: 100%">
                        <el-option
                                v-for="item in genres"
                                :key="item.id"
                                :label="item.genre"
                                :value="item.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="简介">
                    <el-input type="textarea" v-model="addGoods.intro"></el-input>
                </el-form-item>

                <el-form-item label="上传图片">
                    <el-upload

                            ref="add-upload"
                            {{--上传地址--}}
                            action="123"
                            {{--是否自动上传--}}
                            :auto-upload="false"
                            {{--是否支持多选--}}
                            :multiple="false"
                            {{--list-type--}}
                            list-type="picture-card"
                            {{--接收的参数类型--}}
                            ccept=".jpg,.png"
                            {{--文件状态改变时的钩子，添加文件、上传成功和上传失败时都会被调用--}}
                            :on-change="handleFileChange"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            {{--覆盖默认上传事件--}}
                            :http-request="upload"
                            {{--:on-progress="onProgress(e)"--}}
                            :withCredentials="false">
                        <i class="el-icon-plus"></i>
                        <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且大小不超过2MB</div>

                    </el-upload>
                    <el-dialog :modal="false" :visible.sync="dialogVisible">
                        <img width="100%" :src="dialogImageUrl" alt="">
                    </el-dialog>
                </el-form-item>

            </el-form>
            <span slot="footer" class="dialog-footer">
            <el-button @click="addDialogVisible = false">关 闭</el-button>
            <el-button type="primary" @click="handleSubmit">提 交</el-button>
        </span>
        </el-dialog>


    </section>
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
                    goods: @json($data[0]),
                    genres: @json($data[1]),
                    genre: '',

                    addDialogVisible: false,
                    addGoods: {},
                    addImgUrl: '',

                    dialogImageUrl: '',
                    dialogVisible: false,


                };
            },
            methods: {
                //单击提交按钮时 手动触发上传文件事件
                //覆盖默认上传事件 :http-request="upload"
                // this.$refs['add-upload'].submit() 执行后会调用upload方法进行上传图片处理
                handleSubmit() {
                    this.$refs['add-upload'].submit();
                },
                //上传图片
                upload(params) {
                    let fd = new FormData;
                    fd.append('file', params.file);
                    axios.post('/component/upload', fd, {
                        //允许为上传处理进度事件
                        onUploadProgress: progressEvent => {
                            let percent = (progressEvent.loaded / progressEvent.total * 100) | 0;
                            //调用elemnet组件的原始onProgress方法来显示进度条，需要传递个对象 percent为进度值
                            params.onProgress({percent: percent})
                        }
                    })
                        .then(function (res) {
                            if (res.data.status_code == 200) {
                                //如果图片上传成功 则调用handleAdd方法将数据写入数据库
                                //将服务器返回的图片地址url传递给handleAdd方法一起写入数据库
                                app.handleAdd(res.data.path)
                            } else {
                                app.$message.error(res.data.message);
                            }
                        })
                        .catch(err => {
                            app.$message.error('上传失败！请刷新重试，或联系网站管理员进行处理！');
                            console.log(err)
                        })
                },

                handleAdd(imgPath) {
                    this.addGoods.imgUrl = imgPath;
                    let data = new FormData();
                    data.append('goods', data);
                    axios.post('/admin/goods', data)
                        .then(function (res) {
                            if (res.data.status_code = 200) {
                                app.$message.success((res.data.message));
                            }
                        })
                        .catch(function (err) {
                            app.$message.error('服务器错误，请刷新重试！');
                        })
               },
                handleFileChange(file, fileList) {
                    if (file.raw.type === 'image/jpeg' || file.raw.type === 'image/png') {
                        if (file.size / 1024 / 1024 > 2) {
                            this.clearFiles();
                            this.$message.warning('图片大小不能超过2MB')
                        } else {
                            if (fileList.length > 1) {
                                fileList.splice(0, 1);
                            }
                        }
                    } else {
                        this.clearFiles();
                        this.$message.warning('只能上传jpg/png格式图片')
                    }
                },
                handleRemove(file, fileList) {
                    console.log(file, fileList);
                },
                handlePictureCardPreview(file) {
                    this.dialogImageUrl = file.url;
                    this.dialogVisible = true;
                },
                //清空文件列表
                clearFiles() {
                    this.$refs['add-upload'].clearFiles();
                }

            },
        })
    </script>

    <style>
        #content {
            padding: 10px;
            height: 100%;
            background-color: white;
        }

        .topBox {
            position: sticky;
            top: 10px;
            height: 70px;
            padding: 10px;
            line-height: 50px;
            border-bottom: solid 1px rgb(245, 240, 240);
        }

        .title {
            margin: 0;
            margin-left: 10px;
            min-width: 300px;
            font-size: 22px;
        }

        .btn_add {
            float: right;
            margin-right: 10px;
        }

        .list {
            padding-top: 20px;
            padding-bottom: 50px;
        }

        .list th {
            text-align: center;
        }

        .el-upload-dragger {
            width: 178px;
            height: 178px;
            line-height: 178px;
        }

        .avatar-uploader,
        .avatar-uploader-icon {
            font-size: 28px;
            color: #8c939d;
            text-align: center;
        }

        .el-upload--picture-card {
            border: none;
        }

        .avatar {
            display: block;
        }

        .paging {
            position: fixed;
            bottom: 0;
            left: 45%;
        }
    </style>
@endsection