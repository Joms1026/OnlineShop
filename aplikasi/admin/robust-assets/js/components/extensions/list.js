$(document).ready(function(){function a(){u=$(u.selector),v=$(v.selector),u.on("click",function(){var a=$(this).closest("tr").find(".id").text();n.remove("id",a)}),v.on("click",function(){var a=$(this).closest("tr").find(".id").text(),b=n.get("id",a)[0].values();o.val(b.id),p.val(b.name),q.val(b.age),r.val(b.city),t.show(),s.hide()})}function b(){p.val(""),q.val(""),r.val("")}var c={valueNames:["name","born"]},d=(new List("basic-list",c),{valueNames:["name","born"]}),e=[{name:"Martina Elm",born:1986}],f=new List("add-item-list",d,e);f.add({name:"Gustaf Lindqvist",born:1983});var g={valueNames:["name","born"],item:'<li class="list-group-item"><h3 class="name"></h3><p class="born"></p></li>'},h=[{name:"Jonny Strömberg",born:1986},{name:"Jonas Arnklint",born:1985},{name:"Martina Elm",born:1986}],i=new List("new-list",g,h);i.add({name:"Gustaf Lindqvist",born:1983});var j={valueNames:["name","born"]},k=(new List("table-list",j),{valueNames:["id","name","born",{data:["id"]},{attr:"src",name:"image"},{attr:"href",name:"link"},{attr:"data-timestamp",name:"timestamp"}]}),l=new List("data-attributes-list",k);l.add({name:"Leia",born:"1954",image:"robust-assets/images/portrait/small/avatar-s-8.png",link:"http://pixinvent.com",id:5,timestamp:"67893"});var m={valueNames:["id","name","age","city"]},n=new List("editable-list",m),o=$("#id-field"),p=$("#name-field"),q=$("#age-field"),r=$("#city-field"),s=$("#add-btn"),t=$("#edit-btn").hide(),u=$(".remove-item-btn"),v=$(".edit-item-btn");a(),s.on("click",function(){n.add({id:Math.floor(11e4*Math.random()),name:p.val(),age:q.val(),city:r.val()}),b(),a()}),t.on("click",function(){var a=n.get("id",o.val())[0];a.values({id:o.val(),name:p.val(),age:q.val(),city:r.val()}),b(),t.hide(),s.show()});new List("fuzzy-search-list",{valueNames:["name"],plugins:[ListFuzzySearch()]}),new List("pagination-list",{valueNames:["name"],page:3,plugins:[ListPagination({})]})});