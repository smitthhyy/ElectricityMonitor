@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-light mb-4">
                    <div class="card-header bg-dark text-white h4">Power from the street</div>
                    <div class="card-body">
                        <p class="card-text h5"><strong>Total: </strong><span id="total"></span></p>
                        <p class="card-text"><strong>Phase 1: </strong><span id="ch1"></span></p>
                        <p class="card-text"><strong>Phase 2: </strong><span id="ch2"></span></p>
                        <p class="card-text"><strong>Phase 3: </strong><span id="ch3"></span></p>
                        <p class="card-text"><strong>As at: </strong><span id="asAt"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card bg-light mb-8">
                    <div class="card-header bg-dark text-white h4">Power from the street</div>
                    <div class="card-body" style="background-color: #1b1e21">
                        <div id="infeedGauge" style="width:500px; height:269px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card bg-light mb-6">
                    <div class="card-header bg-dark text-white h4">Cost last hour</div>
                    <div class="card-body">
                        <p class="card-text h5"><strong>Total: </strong><span id="totalCostLastHour"></span></p>
                        <p class="card-text"><strong>Phase 1: </strong><span id="ch1CostLastHour"></span></p>
                        <p class="card-text"><strong>Phase 2: </strong><span id="ch2CostLastHour"></span></p>
                        <p class="card-text"><strong>Phase 3: </strong><span id="ch3CostLastHour"></span></p>
                        <p class="card-text"><strong>As at: </strong><span id="asAtCostLastHour"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.3.0/echarts-en.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script>

        var infeedGauge = echarts.init(document.getElementById('infeedGauge'));

        option = {
            backgroundColor: '#1a1f23',
            tooltip : {
                formatter: "{a} <br/>{c} {b}"
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            series : [
                {
                    name:'infeedTotal',
                    type:'gauge',
                    min:0,
                    max:10,
                    splitNumber:10,
                    radius: '80%',
                    axisLine: {            // 坐标轴线
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: [[0.1, 'lime'],[0.28, '#1e90ff'],[0.45, '#f9ea43'],[1, '#ff4500']],
                            width: 3,
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    axisLabel: {            // 坐标轴小标记
                        textStyle: {       // 属性lineStyle控制线条样式
                            fontWeight: 'bolder',
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    axisTick: {            // 坐标轴小标记
                        length :15,        // 属性length控制线长
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: 'auto',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    splitLine: {           // 分隔线
                        length :25,         // 属性length控制线长
                        lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                            width:3,
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    pointer: {           // 分隔线
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5
                    },
                    title : {
                        offsetCenter: [0, '80%'],
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'bolder',
                            fontSize: 18,
                            fontStyle: 'italic',
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    detail : {
                        backgroundColor: 'rgba(30,144,255,0.8)',
                        borderWidth: 1,
                        borderColor: '#fff',
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5,
                        offsetCenter: [0, '50%'],       // x, y，单位px
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'normal',
                            color: '#fff',
                            fontSize: 14,
                        }
                    },
                    data:[{value: 40, name: 'total kiloWatt'}]
                },
                {
                    name:'phase1',
                    type:'gauge',
                    center : ['15%', '75%'],    // 默认全局居中
                    radius : '50%',
                    min:0,
                    max:8,
                    splitNumber:8,
                    axisLine: {            // 坐标轴线
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: [[0.1, 'lime'],[0.28, '#1e90ff'],[0.45, '#f9ea43'],[1, '#ff4500']],
                            width: 2,
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    axisLabel: {            // 坐标轴小标记
                        textStyle: {       // 属性lineStyle控制线条样式
                            fontWeight: 'bolder',
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    axisTick: {            // 坐标轴小标记
                        length :12,        // 属性length控制线长
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: 'auto',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    splitLine: {           // 分隔线
                        length :20,         // 属性length控制线长
                        lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                            width:3,
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    pointer: {
                        width:5,
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5
                    },
                    title : {
                        offsetCenter: [0, '-20%'],       // x, y，单位px
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'lighter',
                            fontStyle: 'italic',
                            fontSize: 12,
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    detail : {
                        backgroundColor: 'rgba(30,144,255,0.8)',
                        borderWidth: 1,
                        borderColor: '#fff',
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5,
                        offsetCenter: [0, '60%'],       // x, y，单位px
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'normal',
                            color: '#fff',
                            fontSize: 12,
                        }
                    },
                    data:[{value: 0, name: 'phase1'}]
                },
                {
                    name:'phase2',
                    type:'gauge',
                    center : ['15%', '28%'],    // 默认全局居中
                    radius : '50%',
                    min:0,
                    max:8,
                    splitNumber:8,
                    axisLine: {            // 坐标轴线
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: [[0.1, 'lime'],[0.28, '#1e90ff'],[0.45, '#f9ea43'],[1, '#ff4500']],
                            width: 2,
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    axisLabel: {            // 坐标轴小标记
                        textStyle: {       // 属性lineStyle控制线条样式
                            fontWeight: 'bolder',
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    axisTick: {            // 坐标轴小标记
                        length :12,        // 属性length控制线长
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: 'auto',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    splitLine: {           // 分隔线
                        length :20,         // 属性length控制线长
                        lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                            width:3,
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    pointer: {
                        width:5,
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5
                    },
                    title : {
                        offsetCenter: [0, '-20%'],       // x, y，单位px
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'lighter',
                            fontStyle: 'italic',
                            fontSize: 12,
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    detail : {
                        backgroundColor: 'rgba(30,144,255,0.8)',
                        borderWidth: 1,
                        borderColor: '#fff',
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5,
                        offsetCenter: [0, '60%'],       // x, y，单位px
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'normal',
                            color: '#fff',
                            fontSize: 12,
                        }
                    },
                    data:[{value: 0, name: 'phase2'}]
                },
                {
                    name:'phase3',
                    type:'gauge',
                    center : ['85%', '28%'],    // 默认全局居中
                    radius : '50%',
                    min:0,
                    max:8,
                    splitNumber:8,
                    axisLine: {            // 坐标轴线
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: [[0.1, 'lime'],[0.28, '#1e90ff'],[0.45, '#f9ea43'],[1, '#ff4500']],
                            width: 2,
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    axisLabel: {            // 坐标轴小标记
                        textStyle: {       // 属性lineStyle控制线条样式
                            fontWeight: 'bolder',
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    axisTick: {            // 坐标轴小标记
                        length :12,        // 属性length控制线长
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: 'auto',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    splitLine: {           // 分隔线
                        length :20,         // 属性length控制线长
                        lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                            width:3,
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    pointer: {
                        width:5,
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5
                    },
                    title : {
                        offsetCenter: [0, '-20%'],       // x, y，单位px
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'lighter',
                            fontStyle: 'italic',
                            fontSize: 12,
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    detail : {
                        backgroundColor: 'rgba(30,144,255,0.8)',
                        borderWidth: 1,
                        borderColor: '#fff',
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5,
                        offsetCenter: [0, '60%'],       // x, y，单位px
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'normal',
                            color: '#fff',
                            fontSize: 12,
                        }
                    },
                    data:[{value: 0, name: 'phase3'}]
                },
                {
                    name:'temp',
                    type:'gauge',
                    center : ['85%', '75%'],    // 默认全局居中
                    radius : '50%',
                    min:-10,
                    max:50,
                    splitNumber:6,
                    axisLine: {            // 坐标轴线
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: [[0.25, '#ff4500'], [0.40,'#f9ea43'], [0.60, 'lime'],[0.75, '#f9ea43'],[1, '#ff4500']],
                            width: 2,
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    axisLabel: {            // 坐标轴小标记
                        textStyle: {       // 属性lineStyle控制线条样式
                            fontWeight: 'bolder',
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10,
                            fontSize: 10
                        }
                    },
                    axisTick: {            // 坐标轴小标记
                        length :12,        // 属性length控制线长
                        lineStyle: {       // 属性lineStyle控制线条样式
                            color: 'auto',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    splitLine: {           // 分隔线
                        length :20,         // 属性length控制线长
                        lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                            width:3,
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    pointer: {
                        width:5,
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5
                    },
                    title : {
                        offsetCenter: [0, '20%'],       // x, y，单位px
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'lighter',
                            fontStyle: 'italic',
                            fontSize: 12,
                            color: '#fff',
                            shadowColor : '#fff', //默认透明
                            shadowBlur: 10
                        }
                    },
                    detail : {
                        backgroundColor: 'rgba(30,144,255,0.8)',
                        borderWidth: 1,
                        borderColor: '#fff',
                        shadowColor : '#fff', //默认透明
                        shadowBlur: 5,
                        offsetCenter: [0, '60%'],       // x, y，单位px
                        textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                            fontWeight: 'normal',
                            color: '#fff',
                            fontSize: 12,
                        }
                    },
                    data:[{value: 19.4, name: 'tempC'}]
                },
            ]
        };

        let currentInfeed = function () {
            $.ajax({url: "{{ route('admin.infeeds.last') }}", success: function(result){
                    $("#asAt").html(result.created_at);
                    $("#ch1").html(result.ch_1 + " watts");
                    $("#ch2").html(result.ch_2 + " watts");
                    $("#ch3").html(result.ch_3 + " watts");
                    let total = result.ch_1 + result.ch_2 + result.ch_3;
                    $("#total").html(total + " watts");

                    option.series[0].data[0].value = (total / 1000).toFixed(3);
                    option.series[1].data[0].value = (result.ch_1 / 1000).toFixed(3);
                    option.series[2].data[0].value = (result.ch_2 / 1000).toFixed(3);
                    option.series[3].data[0].value = (result.ch_3 / 1000).toFixed(3);
                    infeedGauge.setOption(option);
                }
            })
        };

        window.setInterval(function(){
            currentInfeed();
        }, 6000);
        currentInfeed();

        let infeedCostLastHour = function () {
            $.ajax({
                url: "{{ route('admin.infeeds.costlasthour') }}", success: function (result) {
                    $("#asAtCostLastHour").html(moment.unix(result.asAt).format('YYYY-MM-DD HH:mm:ss'));
                    $("#ch1CostLastHour").html(result.ch1.toFixed(3) + " kilowatt/hr cost $" + result.ch1Cost.toFixed(2) + " per hour");
                    $("#ch2CostLastHour").html(result.ch2.toFixed(3) + " kilowatt/hr cost $" + result.ch2Cost.toFixed(2) + " per hour");
                    $("#ch3CostLastHour").html(result.ch3.toFixed(3) + " kilowatt/hr cost $" + result.ch3Cost.toFixed(2) + " per hour");
                    $("#totalCostLastHour").html(result.total.toFixed(3) + " kilowatt/hr cost $" + result.totalCost.toFixed(2) + " per hour");
                }
            });
        };

        window.setInterval(function(){
            infeedCostLastHour();
        }, 60000);
        infeedCostLastHour();

    </script>
@endsection
