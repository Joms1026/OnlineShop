$(window).on("load",function(){function a(b){function g(c){c.children?(c._children=c.children,c.children=null):(c.children=c._children,c._children=null),a(b)}function l(){e=c.node().getBoundingClientRect().width-d.left-d.right,j.attr("width",e+d.left+d.right),k.attr("width",e+d.left+d.right)}var m=s(b);m.forEach(function(a){a.y=180*a.depth+f});var o=k.selectAll("g.node").data(m,function(a){return a.id||(a.id=++h)});m.forEach(function(a){var b=r(a);a.x0=b.x,a.y0=b.y});var t=o.enter().append("g").attr("class","node").attr("transform",function(a){return"translate("+b.y0+","+b.x0+")"}).on("click",g);t.append("circle").attr("r",1e-6).style("stroke","#F6BB42").style("stroke-width",1.5).style("cursor","pointer").style("fill",function(a){return a._children?"#F6BB42":"#fff"}),t.append("text").attr("dy",function(a){return a.isRight?18:-12}).attr("text-anchor","middle").text(function(a){return a.name}).style("font-size",12).style("fill-opacity",1e-6);var u=o.transition().duration(i).attr("transform",function(a){return p=r(a),"translate("+p.y+","+p.x+")"});u.select("circle").attr("r",4.5).style("fill",function(a){return a._children?"#F6BB42":"#fff"}),u.select("text").style("fill-opacity",1);var v=o.exit().transition().duration(i).attr("transform",function(a){return p=r(a.parent||b),"translate("+p.y+","+p.x+")"}).remove();v.select("circle").attr("r",1e-6),v.select("text").style("fill-opacity",1e-6);var w=k.selectAll("path.link").data(n.links(m),function(a){return a.target.id});w.enter().insert("path","g").attr("class","link").style("stroke","#F6BB42").style("fill","none").style("stroke-width",1.5).attr("d",function(a){var c={x:b.x0,y:b.y0};return q({source:c,target:c})}),w.transition().duration(i).attr("d",q),w.exit().transition().duration(i).attr("d",function(a){var c=r(a.source||b);return a.source.isRight?c.y-=f-(a.target.y-a.source.y):c.y+=f-(a.target.y-a.source.y),q({source:c,target:c})}).remove(),$(window).on("resize",l),$(".menu-toggle").on("click",l)}var b,c=d3.select("#bracket-tree"),d={top:0,right:0,bottom:0,left:0},e=c.node().getBoundingClientRect().width-d.left-d.right,f=e/2,g=600-d.top-d.bottom-5,h=0,i=500,j=c.append("svg"),k=j.attr("width",e+d.left+d.right).attr("height",g+d.top+d.bottom).append("g").attr("transform","translate("+d.left+","+d.top+")"),l=function(a){var b=[];if(a.winners)for(var c=0;c<a.winners.length;c++)a.winners[c].isRight=!1,a.winners[c].parent=a,b.push(a.winners[c]);if(a.challengers)for(var c=0;c<a.challengers.length;c++)a.challengers[c].isRight=!0,a.challengers[c].parent=a,b.push(a.challengers[c]);return b.length?b:null},m=d3.behavior.zoom().scaleExtent([1,2]).on("zoom",function(){k.attr("transform","translate("+d3.event.translate+") scale("+d3.event.scale+")")});j.call(m);var n=d3.layout.tree().size([g,e]),o=(d3.svg.diagonal().projection(function(a){return[a.y,a.x]}),function(a,b){var c=r(a.source),d=r(a.target),e=(d.y-c.y)/2;return a.isRight&&(e=-e),"M"+c.y+","+c.x+"H"+(c.y+e)+"V"+d.x+"H"+d.y}),q=o,r=function(a){var b=a.y;return a.isRight||(b=a.y-f,b=f-b),{x:a.x,y:b}},s=function(a,b){b=b||[];var c=0,d=a.children?a.children.length:0;for(b.push(a);c<d;c++)s(a.children[c],b);return b};d3.json("robust-assets/demo-data/d3/tree/bracket-tree.json",function(c){b=c,b.x0=g/2,b.y0=e/2;var d=d3.layout.tree().size([g,f]).children(function(a){return a.winners}),h=d3.layout.tree().size([g,f]).children(function(a){return a.challengers});d.nodes(b),h.nodes(b);var i=function(a){a.children=l(a),a.children&&a.children.forEach(i)};i(b),b.isRight=!1,a(b)})});