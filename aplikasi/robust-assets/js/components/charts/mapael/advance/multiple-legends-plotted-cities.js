$(window).on("load",function(){$(".multiple-legends-plotted-cities").mapael({map:{name:"usa_states",defaultArea:{attrs:{fill:"#E84A5F",stroke:"#FFFFFF"},attrsHover:{fill:"#99B898"}}},legend:{plot:[{labelAttrs:{fill:"#2A363B"},titleAttrs:{fill:"#2A363B"},cssClass:"population",mode:"horizontal",title:"Population",marginBottomTitle:5,slices:[{size:15,legendSpecificAttrs:{fill:"#00a1fe",stroke:"#f4f4e8","stroke-width":2},label:"< 10 000",max:"10000"},{size:30,legendSpecificAttrs:{fill:"#00a1fe",stroke:"#f4f4e8","stroke-width":2},label:"> 10 000 and < 100 000",min:"10000",max:"100000"},{size:50,legendSpecificAttrs:{fill:"#00a1fe",stroke:"#f4f4e8","stroke-width":2},label:"> 100 000",min:"100000"}]},{labelAttrs:{fill:"#2A363B"},titleAttrs:{fill:"#2A363B"},cssClass:"density",mode:"horizontal",title:"Density",marginBottomTitle:5,slices:[{label:"< 50",max:"50",attrs:{fill:"#fef500"},legendSpecificAttrs:{r:25}},{label:"> 50 and < 500",min:"50",max:"500",attrs:{fill:"#fe6c00"},legendSpecificAttrs:{r:25}},{label:"> 500",min:"500",attrs:{fill:"#dc0000"},legendSpecificAttrs:{r:25}}]}]},plots:{ny:{latitude:40.717079,longitude:-74.00116,tooltip:{content:"New York"},value:[5e3,20]},an:{latitude:61.2108398,longitude:-149.9019557,tooltip:{content:"Anchorage"},value:[5e4,20]},sf:{latitude:37.792032,longitude:-122.394613,tooltip:{content:"San Francisco"},value:[15e4,20]},pa:{latitude:19.493204,longitude:-154.8199569,tooltip:{content:"Pahoa"},value:[5e3,200]},la:{latitude:34.025052,longitude:-118.192006,tooltip:{content:"Los Angeles"},value:[5e4,200]},dallas:{latitude:32.784881,longitude:-96.808244,tooltip:{content:"Dallas"},value:[15e4,200]},miami:{latitude:25.789125,longitude:-80.205674,tooltip:{content:"Miami"},value:[5e3,2e3]},washington:{latitude:38.905761,longitude:-77.020746,tooltip:{content:"Washington"},value:[5e4,2e3]},seattle:{latitude:47.599571,longitude:-122.319426,tooltip:{content:"Seattle"},value:[15e4,2e3]},test1:{latitude:44.671504,longitude:-110.957968,tooltip:{content:"Test 1"},value:[5e3,2e3]},test2:{latitude:40.667013,longitude:-101.465781,tooltip:{content:"Test 2"},value:[5e4,200]},test3:{latitude:38.362031,longitude:-86.875938,tooltip:{content:"Test 3"},value:[15e4,20]}}})});