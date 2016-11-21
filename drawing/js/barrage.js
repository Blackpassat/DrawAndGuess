// import $ from 'jquery'; 

var playList = [{
    //从何时开始
    time:0,
    //经过的时间
    duration:4292,
    //舞台偏移的高度
    top:10,
    //弹幕文字大小
    size:16,
    //弹幕颜色
    color:'#000',
    //内容
    text:'前方高能注意'
},{
    //从何时开始
    time:100,
    //经过的时间
    duration:4192,
    //舞台偏移的高度
    top:100,
    //弹幕文字大小
    size:14,
    //弹幕颜色
    color:'#333',
    //内容
    text:'我就是路过看看。。'
},{
    //从何时开始
    time:170,
    //经过的时间
    duration:6192,
    //舞台偏移的高度
    top:130,
    //弹幕文字大小
    size:16,
    //弹幕颜色
    color:'#00ff00',
    //内容
    text:'我就静静的看着你装逼。。'
},{
    //从何时开始
    time:1000,
    //经过的时间
    duration:5992,
    //舞台偏移的高度
    top:150,
    //弹幕文字大小
    size:20,
    //弹幕颜色
    color:'#ff0000',
    //内容
    text:'我和我的小伙伴都惊呆了～～'
}]

//弹幕的总时间（演出总时间）
var Time = 6000;
//检测时间间隔（每一场的时间）
var CheckTime = 1000;
//总场数
var PlayCount = Math.ceil(Time / CheckTime);


//构造函数，传递一个剧本片段
var Actor = function(play){
    //保存剧本的副本
    this.play = play;
    //给自己化妆
    this.appearance = this.makeUp();
    //自己走上舞台旁边准备上场
    this.appearance.hide().appendTo(stage);
}

//演员化妆，也就是最终呈现的样子
Actor.prototype.makeUp = function() {
    var appearance = $('<div style="min-width:400px;font-size:'+this.play.size +';color:'+this.play.color+';">'+this.play.text+'</div>');
    return appearance;
}

//演员上场飘过
Actor.prototype.animate = function() {
    var that = this;
    var appearance = that.appearance;
    var mywidth = appearance.width();
    //使用动画控制left
    appearance.animate({
        left:-mywidth
    }, that.play.duration,'swing',function(){
        appearance.hide();
    });
}

//演员开始表演
Actor.prototype.perform = function() {
    var that = this;
    var appearance = that.appearance;

    //准备入场,先隐藏在幕布后面
    appearance.css({
        position:'absolute',
        left: stage.width()+'px',
        top:that.play.top||0,
        zIndex:10,
        display:'block'
    });
    //确定入场偏移时间，入场表演
    //导演只会说第几场开始了，可不会还帮你具体到某个时间点，所以需要你自己计算好入场的时间。
    var delayTime = that.play.time - (that.play.session-1) * CheckTime;
    //演员需要修正自己上场的时间
    setTimeout(function(){
        that.animate();
    },delayTime)

}



var director = $({});


//准备舞台（这个上面其实已经说了）
var stage = $('#J_stage');
stage.css({
    position:'relative',
    overflow:'hidden'
})

//导演开始说戏过剧本
//整理playList列表，组装事件
$.each(playList,function(k,play){
    //确定演员，确定场次
    var session = Math.ceil(play.time / CheckTime);
    play.session = session;
    //剧本拿给演员,召唤一个演员
    var actor = new Actor(play);
    //演员针对导演添加监听。
    //等导演说了这个场次后，就开始叫演员表演
    director.on(session+'start',function(){
        actor.perform();
    })
})

currentSession = 0;

setInterval(function(){
    //第xx场开始表演
    director.trigger(currentSession+'start');
    //从头再来一遍
    if (currentSession === PlayCount) {
        currentSession = 0;
    }else{
        currentSession++;
    }

},CheckTime);