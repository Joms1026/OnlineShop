$(document).ready(function(){function a(){var b=$(".second"),c=$(".minute"),d=$(".hour"),e=new Date,f=e.getSeconds(),g=e.getMinutes(),h=e.getHours();b.val(f).trigger("change"),c.val(g).trigger("change"),d.val(h).trigger("change"),t=setTimeout(function(){a()},1e3)}var b=!1;"RTL"==$("html").data("textdirection")&&(b=!0),$(".knob").knob({rtl:b,change:function(a){},release:function(a){},cancel:function(){},draw:function(){if("tron"==this.$.data("skin")){this.cursorExt=.3;var a,b=this.arc(this.cv),c=1;return this.g.lineWidth=this.lineWidth,this.o.displayPrevious&&(a=this.arc(this.v),this.g.beginPath(),this.g.strokeStyle=this.pColor,this.g.arc(this.xy,this.xy,this.radius-this.lineWidth,a.s,a.e,a.d),this.g.stroke()),this.g.beginPath(),this.g.strokeStyle=c?this.o.fgColor:this.fgColor,this.g.arc(this.xy,this.xy,this.radius-this.lineWidth,b.s,b.e,b.d),this.g.stroke(),this.g.lineWidth=2,this.g.beginPath(),this.g.strokeStyle=this.o.fgColor,this.g.arc(this.xy,this.xy,this.radius-this.lineWidth+1+2*this.lineWidth/3,0,2*Math.PI,!1),this.g.stroke(),!1}}}),a();var c,d=0,e=0,f=0,g=$(".idir"),h=$(".ival"),i=function(){f++,g.show().html("+").fadeOut(),h.html(f)},j=function(){f--,g.show().html("-").fadeOut(),h.html(f)};$(".infinite").knob({min:0,max:20,stopper:!1,change:function(){c>this.cv?d?(j(),d=0):(d=1,e=0):c<this.cv&&(e?(i(),e=0):(e=1,d=0)),c=this.cv}})});