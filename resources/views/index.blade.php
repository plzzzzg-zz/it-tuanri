<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css"></script>
    <title>Laravel</title>

</head>
<body>
<div class="container">
    <div id="form">
        <div class="input-group">
            <label for="number">人数 </label>
            <span @click="dec" class="btn btn-danger glyphicon glyphicon-minus pull-right"></span>
            <span @click="add" class="btn btn-info glyphicon glyphicon-plus pull-right"></span>
        </div>
        <div class="input-group">
            <label for="user1">USER1</label>
            <input id="user1" type="text" v-model="names[0]" class="col-xs-12" value="">
        </div>
        <div class="input-group" v-show="number>1">
            <label for="user2">USER2</label>
            <input id="user2" type="text" v-model="names[1]" class="col-xs-12" value="">
        </div>
        <div class="input-group" v-show="number>2">
            <label for="user3">USER3</label>
            <input id="user3" type="text" v-model="names[2]" class="col-xs-12" value="">
        </div>
        <div class="input-group" v-show="number>3">
            <label for="user4">USER4</label>
            <input id="user4" type="text" v-model="names[3]" class="col-xs-12" value="">
        </div>
        <div class="input-group" v-show="number>4">
            <label for="user5">USER5</label>
            <input id="user5" type="text" v-model="names[4]" class="col-xs-12" value="">
        </div>
        <button @click="submit">提交</button>
    </div>
</div>
<script src="{{URL::asset('../node_modules/jquery/dist/jquery.min.js')}}"></script>
<script src="{{URL::asset('../node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('../node_modules/vue/dist/vue.min.js')}}"></script>
<script>
    const form = new Vue({
        el: '#form',
        data: {
            names: [],
            //此处添加其他属性
            number: 1 //初始人数
        },
        methods: {
            add: function () {
                if (this.number < 5) {
                    this.number++;
                }
            },
            dec: function () {
                if (this.number > 1) {
                    this.names[this.number - 1] = "";//消除该成员的数据
                    this.number--;
                }
            },
            submit:function(){
                $.post("index", {//引用jquery函数，目标提交页面
                    "names":this.names,
                    //其他数据段
                });
            }
        }
    });

</script>
</body>

</html>