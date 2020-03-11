@extends('admin.layout.master')

@section('content')
    <section id="content">
        <el-row class="topBox">
            <el-col :md="6" :sm="6" :xs="6">
                <p class="title">商品分类列表</p>
            </el-col>
            <el-col :md="2" :sm="2" :xs="2" :offset="16">
                <el-button type="primary" class="btn_add" @click="addDialogVisible = true">添加分类</el-button>
            </el-col>
        </el-row>


        <el-dialog
                title="添加商品分类"
                :visible="addDialogVisible"
                width="30%"
                :show-close="false"
                :modal-append-to-body='false'>
            <el-input v-model="newGenre"></el-input>
            <span slot="footer" class="dialog-footer">
                <el-button @click="addDialogVisible = false">关 闭</el-button>
                <el-button type="primary" @click="handleAdd">提 交</el-button>
            </span>
        </el-dialog>

        <el-dialog
                title="修改商品分类"
                :visible="eidtDialogVisible"
                width="30%"
                :show-close="false"
                :modal-append-to-body='false'>
            <el-input v-model="currentGenre"></el-input>
            <span slot="footer" class="dialog-footer">
                <el-button @click="eidtDialogVisible = false">关 闭</el-button>
                <el-button type="primary" @click="edit">修 改</el-button>
            </span>
        </el-dialog>


        <el-row class="list">
            <el-col :md="24" :sm="24" :xs="24">
                <el-table
                        style="width: 100%"
                        :data="genres">
                    <el-table-column
                            label="编号"
                            width="180">
                        <template slot-scope="scope">
                            <span style="margin-left: 10px">@{{ scope.$index+1 }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column
                            label="类型"
                            width="180">
                        <template slot-scope="scope">
                            <span>@{{ scope.row.genre }}</span>
                        </template>
                    </el-table-column>

                    <el-table-column label="操作">
                        <template slot-scope="scope">
                            <el-button
                                    size="mini"
                                    v-on:click="handleEdit(scope.$index, scope.row)">编辑
                            </el-button>

                            <el-button
                                    size="mini"
                                    type="danger"
                                    slot="reference"
                                    v-on:click="handleDelete(scope.$index, scope.row)">删除
                            </el-button>
                        </template>
                    </el-table-column>

                </el-table>
            </el-col>
        </el-row>

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
                        active: '1-2',
                    },
                    addDialogVisible: false,
                    eidtDialogVisible: false,
                    genres: @json($data),
                    newGenre: '',
                    currentIndex: null,
                    currentGenre: '',
                    dialogTitle: ''
                };
            },
            mounted() {
            },
            methods: {

                //添加分类
                handleAdd() {
                    let data = new FormData();
                    data.append('genre', this.newGenre);
                    axios.post('/admin/genres', data)
                        .then(function (response) {
                            //添加成功
                            let data = response.data;
                            if ((data.status_code == 200)) {
                                app.genres.push(data.newGenre)
                                app.$message.success(data.message);
                                app.addDialogVisible = false;
                                //添加失败
                            } else if (data.status_code == 500) {
                                app.$message.error(response.data.error[0]);
                            }
                        })
                        .catch(function (error) {
                            this.$message.error('服务器错误，请检查网络是否正常后重试！')
                        });

                    this.newGenre = ''
                },


                //修改分类
                handleEdit(index, row) {
                    this.currentGenre = row.genre;
                    this.currentIndex = index;
                    this.eidtDialogVisible = true;
                },
                edit() {
                    let thisGenre = this.genres[this.currentIndex]
                    let id = thisGenre.id;
                    let data = {'id': id, 'genre': this.currentGenre};
                    axios.patch('/admin/genres/' + id, data)
                        .then(function (response) {
                            //修改成功
                            let data = response.data;
                            if ((data.status_code == 200)) {
                                app.genres[app.currentIndex].genre = data.genre;
                                app.$message.success(data.message);
                                app.eidtDialogVisible = false;
                                //修改失败
                            } else if (data.status_code == 500) {
                                app.$message.error(response.data.error[0]);
                            }
                        })
                        .catch(function (error) {
                            this.$message.error('服务器错误，请检查网络是否正常后重试！')
                        });
                },
                //删除分类
                handleDelete(index, row) {
                    this.$confirm('是否要删除此商品分类？', {
                        confirmButtonText: '删除',
                        cancelButtonText: '取消',
                    }).then(() => {
                        axios.delete('/admin/genres/' + row.id)
                            .then(function (response) {
                                //删除成功
                                app.genres.splice(index, 1);
                                app.$message.success(response.data.message);
                            })
                            .catch(function (error) {
                                this.$message.error('服务器错误，请检查网络是否正常后重试！')
                            });
                    }).catch(() => {
                    });
                },

            },
        })
    </script>

    <style>
        #content {
            padding: 10px;
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

        .list th, .list td div{
            text-align: center;
        }


    </style>
@endsection
