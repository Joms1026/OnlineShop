$(window).on("load",function(){function a(){f=d.node().getBoundingClientRect().width,h=e.node().getBoundingClientRect().width,pie_x=f/2,pie_y=g/2,donut_x=h/2,donut_y=i/2,j.attr("width",f),d3.select("#quotesDonut g").attr("transform","translate("+pie_x+","+pie_y+")"),k.attr("width",h),d3.select("#salesDonut g").attr("transform","translate("+donut_x+","+donut_y+")")}var b=[{label:"Basic",value:25,color:"#99B898"},{label:"Plus",value:11,color:"#FECEA8"},{label:"Lite",value:22,color:"#FF847C"},{label:"Elite",value:28,color:"#E84A5F"},{label:"Delux",value:14,color:"#F8B195"}],c=[{label:"Basic",value:32,color:"#99B898"},{label:"Plus",value:14,color:"#FECEA8"},{label:"Lite",value:19,color:"#FF847C"},{label:"Elite",value:12,color:"#E84A5F"},{label:"Delux",value:23,color:"#F8B195"}],d=d3.select("#pie-3d"),e=d3.select("#donut-3d"),f=d.node().getBoundingClientRect().width,g=500,h=e.node().getBoundingClientRect().width,i=500,j=d.append("svg").attr("width",f).attr("height",g),k=e.append("svg").attr("width",h).attr("height",i);j.append("g").attr("id","quotesDonut"),k.append("g").attr("id","salesDonut"),Donut3D.draw("quotesDonut",b,f/2,g/2,250,210,40,0),Donut3D.draw("salesDonut",c,h/2,i/2,250,210,40,.4),$(window).on("resize",a),$(".menu-toggle").on("click",a)});