$(window).on("load",function(){var a=c3.generate({bindto:"#to-bar",size:{height:400},color:{pattern:["#673AB7","#E91E63"]},data:{columns:[["data1",30,200,100,400,150,250],["data2",130,100,140,200,150,50]],type:"line"},grid:{y:{show:!0}}});setTimeout(function(){a.transform("bar","data1")},1e3),setTimeout(function(){a.transform("bar","data2")},2e3),setTimeout(function(){a.transform("line")},3e3),setTimeout(function(){a.transform("bar")},4e3),$(".menu-toggle").on("click",function(){a.resize()})});