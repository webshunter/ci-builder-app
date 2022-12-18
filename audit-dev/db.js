class ControlTable {
    constructor(a) {
        this.table = a
        this.dataRow = [];
    }

    ai(name) {
        this.dataRow.push(` \`${name}\` INT(11) AUTO_INCREMENT PRIMARY KEY `)
    }

    char(name, length, def) {
        this.dataRow.push(` \`${name}\` VARCHAR(${length}) NOT NULL DEFAULT '${def}' `)
    }

    text(name) {
        this.dataRow.push(` \`${name}\` TEXT `)
    }

    longtext(name) {
        this.dataRow.push(` \`${name}\` LONGTEXT `)
    }

    timecreate(name) {
        this.dataRow.push(` \`${name}\` DATETIME NULL DEFAULT CURRENT_TIMESTAMP `)
    }

    timeupdate(name) {
        this.dataRow.push(` \`${name}\` DATETIME NULL DEFAULT CURRENT_TIMESTAMP `)
    }

    cek() {
        query(`SELECT * FROM \`${this.table}\``, function (a) {
            console.log(a)
        })
    }

    createTable(func) {
        var createTable = `CREATE TABLE \`${this.table}\` (
                        ${this.dataRow.join(", \n   ")}
                    )
                    `;
        query(createTable, function (a) {
            func(a)
        })

    }
}

function compare( a, b ) {
  if ( a.last_nom < b.last_nom ){
    return -1;
  }
  if ( a.last_nom > b.last_nom ){
    return 1;
  }
  return 0;
}

Array.prototype.dinamicSort = function(property){
    var sortOrder = 1;
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        /* next line works with strings and numbers,
         * and you may want to customize it to your needs
         */
        var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
};

Number.prototype.pad = function(length) {
    var s = this;
    var number = s.valueOf()
    var str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }
    return str;
}

Array.prototype.dinamicSortMultiple = function(){
    /*
     * save the arguments object as it will be overwritten
     * note that arguments object is an array-like object
     * consisting of the names of the properties to sort by
     */
    var dynamicSort = function(property){
        var sortOrder = 1;
        if(property[0] === "-") {
            sortOrder = -1;
            property = property.substr(1);
        }
        return function (a,b) {
            /* next line works with strings and numbers,
             * and you may want to customize it to your needs
             */
            var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
            return result * sortOrder;
        }
    };
    var props = arguments;
    return function (obj1, obj2) {
        var i = 0, result = 0, numberOfProperties = props.length;
        /* try getting a different result from 0 (equal)
         * as long as we have extra properties to compare
         */
        while(result === 0 && i < numberOfProperties) {
            result = dynamicSort(props[i])(obj1, obj2);
            i++;
        }
        return result;
    }
}

Array.prototype.sortArrayObjectAsc = function(param){
    var arr = this;
    var dinamicFunc = this.dinamicSort;
    return arr.sort(dinamicFunc(param));
}

Array.prototype.sortArrayObjectMultiple = function(){
    var arr = this;
    var props = arguments;
    var dynamicSortMultiple = this.dinamicSortMultiple;
    return arr.sort(dynamicSortMultiple(...props));
}

Array.prototype.sortArrayObjectDesc = function(param){
    var arr = this;
    var dinamicFunc = this.dinamicSort;
    return arr.sort(dinamicFunc('-'+param));
}

globalThis.ArrayNumberExample = [0,1,2,3,4,5,6,7,8,9];

Array.prototype.asc = function(param){
    return this.sort();
}

Array.prototype.sum = function(){
    function myFunc(total, num) {
      return total + num;
    }
    if(this.length > 0){
        return this.reduce(myFunc);
    }else{
        return 0;
    }
}

Array.prototype.desc = function(param){
    return this.reverse();
}

globalThis.ArrayObjectExample = [
    {Name: "Name", Surname: "Surname"},
    {Name:"AAA", Surname:"ZZZ"},
    {Name: "Name", Surname: "AAA"}
];

String.prototype.number = function(fn = false){
    var s = this;
    if(fn == 2){
        s = s.replace(/\./g, ',');
    }
    s = s.replace(/[^,\d]/g, '');
    if(s == null){
        s = '0';
    }
    if(fn == false){
        return Number(s.replace(/\./g,'').replace(/\,/g,'.'));
    }else if(fn == true){
      console.log(s);
        return s.replace(/\./g,'');
    }else if(fn == 2){
        return Number(s.replace(/\,/g, '.'));
    }else{
        return Number(s.replace(/\./g,'').replace(/\,/g,'.'));
    }
}

Array.prototype.count = function (a, val) {
    var t = this
    if(a != undefined && val != undefined){
        return t.filter(function(dat,x){
            if(dat[a] == val){
                return dat;
            }
        }).length
    }else{
        return 0;
    }
}

Array.prototype.row = function (a, val) {
    var t = this
    if(a != undefined && val != undefined){
        var g = t.filter(function(dat,x){
            if(dat[a] == val){
                return dat;
            }
        })
        if(g.length > 0){
            return g[0];
        }else{
            return g;
        }
    }else{
        return t
    }
}

Array.prototype.del = function (a, val) {
    var t = this
    if(a != undefined && val != undefined){
        return t.filter(function(dat,x){
            if(dat[a] != val){
                return dat;
            }
        })
    }else{
        return t
    }
}

String.prototype.currency = function(){
    var s = this;
    s = s.replace(/\,/g, '.');
    if(s != ''){
      s = this.formatRupiah();
    }
    return s;
}

String.prototype.lastDotToComa = function(){
    var s = this;
    var l = this.length - 1;
    var sl = s.slice(0, l);
    if(s[l] == '.'){
        return sl+',';
    }else{
        return s+'';
    }
}

window.ifnull = function(a, b){
    if(a == null){
        return b;
    }else{
        return a;
    }
}

window.nullif = function(a, b){
    if(a == b){
        return null;
    }else{
        return a;
    }
}

String.prototype.capitaize = function(){
    var str = this;
    return str.toLowerCase().replace(/(?:^|\s|["'([{])+\S/g, match => match.toUpperCase())
}

String.prototype.formatRupiah = function(){
    var angka = this;
    if(angka == null || angka == ''){
        angka = 0;
        angka = angka.toFixed(2).replace(/\./g, ',');
    }
    var negative = '';
    if (angka[0] == '-') {
        negative = '-';
    }
    var angka = angka.replace(/\./g, ',')
    var prefix;
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split           = number_string.split(','),
    sisa            = split[0].length % 3,
    rupiah          = split[0].substr(0, sisa),
    ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? negative+rupiah : (rupiah ? '' + negative+rupiah : '');
}

Number.prototype.currency = function(a){
    var s = this;
    if(s == null){
        s = 0;
    }
    var num = s.valueOf().toFixed(a).formatRupiah();
    return num;
}

String.prototype.t2b = function(){
    var string = JSON.stringify(this);
    return string.split('').map(function (char) {
        return char.charCodeAt(0).toString(2);
    }).join('2');
}

String.prototype.b2t = function(){
    var array = this.split("2");
    var pop = array.map(code => String.fromCharCode(parseInt(code, 2))).join("");
    return JSON.parse(pop);
}

String.prototype.left = function(number){
    return this.substring(0,number);
}

Array.prototype.t2b = function(){
    var string = JSON.stringify(this);
    return string.split('').map(function (char) {
        return char.charCodeAt(0).toString(2);
    }).join('2');
}

Array.prototype.duplikasi = function(name){
    var arr = this.sortArrayObjectAsc(name);
    var cek = null;
    var baru = [];
    arr.forEach(function(d,i){
        if(cek != d[name]){
            baru.push(d);
            cek = d[name];
        }
    })
    return baru;
}

window.t2b = function(){
    var string = this.toString();
    return string.split('').map(function (char) {
        return char.charCodeAt(0).toString(2);
    }).join('2');
};

String.prototype.replaceAll = function (find, replace) {
    var str = this;
    return str.replace(new RegExp(find.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'), 'g'), replace);
};

Array.prototype.search = function(search = ''){

    if(typeof search == 'number'){
        search = search.toString().toLowerCase();
    }else{
        search = search.toLowerCase();
    }

    var data = this;
    return data.filter(function(dat){
        if(typeof dat == 'object'){
            var f = Object.keys(dat);
            var numcek = 0;
            for(var t of f){
                var g = dat[t];
                if(g != null){
                    if(typeof g == 'number'){
                        g = g.toString().toLowerCase();
                    }else{
                        g = g.toLowerCase();
                    }
                    if(numcek == 0){
                        if(g.indexOf(search) != -1){
                            numcek = 1;
                        }
                    }
                }
            }
            if(numcek == 1){
                return dat;
            }
        }else{
            if(dat != null){
                if(typeof dat == 'number'){
                    var dats = dat.toString().toLowerCase();
                    if(dats.indexOf(search) != -1){
                        return dat
                    }
                }else{
                    if(dat.indexOf(search) != -1){
                        return dat
                    }
                }
            }
        }
    })
}

Array.prototype.cond = function(search = '', name = ''){
    if(search != ''){
        if(typeof search == 'number'){
            search = search.toString().toLowerCase();
        }else{
            search = search.toLowerCase();
        }

        var data = this;
        return data.filter(function(dat){
            if(typeof dat == 'object'){
                var g = dat[name];
                var numcek = 0;
                if(g != null){
                    if(typeof g == 'number'){
                        g = g.toString().toLowerCase();
                    }else{
                        g = g.toLowerCase();
                    }
                    if(numcek == 0){
                        if(g == search){
                            numcek = 1;
                        }
                    }
                }
                if(numcek == 1){
                    return dat;
                }
            }else{
                if(dat != null){
                    if(typeof dat == 'number'){
                        var dats = dat.toString().toLowerCase();
                        if(dats  == search){
                            return dat
                        }
                    }else{
                        if(dat.toLowerCase() == search){
                            return dat
                        }
                    }
                }
            }
        })
    }else{
        return this;
    }
}

globalThis.cronTab = function(action, tim){
    var times = 3000;
    if(tim != undefined){
        if(typeof tim == 'number'){
            times = tim;
        }
    }
    var newIdCron = Date.now();
    globalThis.cronIdSetUpNewSession = newIdCron;
    setInterval(function(){
        if(newIdCron == globalThis.cronIdSetUpNewSession){
            if(action != undefined){
                action()
            }
        }
    },times)
}


globalThis.loadPlugins = function(path='', arr = [], func){
    var pt = path;
    var start = 0;
    var length = arr.length - 1;
    var dataScript = "";
    (function loadas(){
        fetch(path+'/'+arr[start]+'.js?v='+Date.now()).then(function(res){
            return res.text();
        })
        .then(function(textScript){
            dataScript += textScript+"\n";
            if(start == length){
                eval(dataScript);
                if(func != undefined){
                    func();
                }
            }else{
                start++;
                loadas();
            }
        })
    })();
}

globalThis.lE = function(name){
    return globalThis[name];
}

globalThis.props = function(params = null, value = null){
    if(params != null){
        if(window.propertyWebsiteApp == undefined){
            window.propertyWebsiteApp = {}
        }
        if(value != null){
            window.propertyWebsiteApp[params] = value;
        }else{
            if(window.propertyWebsiteApp[params] != undefined){
                return window.propertyWebsiteApp[params];
            }else{
                return null;
            }
        }
    }else{
        return null;
    }
}

// proto element


window.localD = {
    read : function(name){
        if(localStorage.getItem('localdata') == undefined){
            var dat = {}
            localStorage.setItem('localdata', JSON.stringify(dat));
        }
        if( JSON.parse(localStorage.getItem('localdata'))[name] == undefined ){
            return 0;
        }else{
            return JSON.parse(localStorage.getItem('localdata'))[name];
        }
    },
    write: function(name, data){
        if(localStorage.getItem('localdata') == undefined){
            var dat = {}
            localStorage.setItem('localdata', JSON.stringify(dat));
        }
        var y = JSON.parse(localStorage.getItem('localdata'));
        y[name] = data;
        localStorage.setItem('localdata', JSON.stringify(y))
    }
}

Node.prototype.readonly = function(){
    this.setAttribute('readonly','');
    this.style.background = '#ddd';
}

Node.prototype.inputRupiah = function(){
    this.addEventListener('keyup', function(){
      if(this.value != ''){
          this.value = this.value.lastDotToComa().number(true).currency();
      }
    }, false)
}

Node.prototype.uuid = function(){
  function generateUUID() { // Public Domain/MIT
    var d = new Date().getTime();//Timestamp
    var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now()*1000)) || 0;//Time in microseconds since page-load or 0 if unsupported
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16;//random number between 0 and 16
        if(d > 0){//Use timestamp until depleted
            r = (d + r)%16 | 0;
            d = Math.floor(d/16);
        } else {//Use microseconds since page-load if supported
            r = (d2 + r)%16 | 0;
            d2 = Math.floor(d2/16);
        }
        return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
  }
  this.value = generateUUID();
}

Node.prototype.uuidtime = function(aliase = ''){
  this.value = aliase+Date.now();
}

globalThis.getform = function(id){
    return document.querySelector('#form-get-app'+act.data.id+' #'+id);
}

globalThis.selectNode = function(a){
  return document.querySelector(a);
}

globalThis.getNode = function(id){
  return globalThis[id];
}

globalThis.Keys = function(a){
  return Object.keys(a);
}

const calculator = {
      run : function(id, height=30, output = null){
        this.data = {}
        this.data.newCalculator = document.getElementById(id)

        this.data.idaction = 'api-cal'+Date.now();

        globalThis[this.data.idaction] = function(a){

          if(a.getAttribute('data-val') != undefined){
            output(a.getAttribute('data-val'), a)
          }else{
            if(a.innerText != '.' && a.innerText != ''){

              var val = Number(a.innerText);
              if(output != null){
                output(val, a)
              }
            }else{
              if(output != null){
                output(a.innerText, a)
              }
            }
          }

        }

        this.data.newCalculator.innerHTML = `
        <style>
          .gg-math-plus,
          .gg-math-plus::after {
              display: block;
              box-sizing: border-box;
              background: currentColor;
              border-radius: 10px
          }
          .gg-math-plus {
              margin-top: -2px;
              position: relative;
              transform: scale(var(--ggs,1));
              width: 16px;
              height: 2px
          }
          .gg-math-plus::after {
              content: "";
              position: absolute;
              width: 2px;
              height: 16px;
              top: -7px;
              left: 7px
          }
          .gg-math-minus {
              box-sizing: border-box;
              position: relative;
              display: block;
              transform: scale(var(--ggs,1));
              width: 16px;
              height: 2px;
              background: currentColor;
              border-radius: 10px
          }
        </style>
          <div style="display:grid;grid-template-columns: auto 60px">
            <div style="
                display:grid;
                grid-template-columns:auto auto auto;
              ">
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">1</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">2</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">3</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">4</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">5</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">6</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">7</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">8</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">9</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">0</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                ">.</div>
                <div onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                "></div>
            </div>
            <div style="
              display:grid;
              grid-template-columns: auto;
            ">

              <div action-do-calc onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                  font-size: 12px;
                " data-val="qty">
                  Qty
                </div>

              <div action-do-calc onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                  font-size: 12px;
                " data-val="disc">
                  Disc
                </div>

              <div action-do-calc onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                  font-size: 12px;
                " data-val="price">
                  Price
                </div>

              <div action-do-calc onclick="globalThis['${this.data.idaction}'](this)" style="
                  display: flex;
                  height: ${height}px;
                  cursor: pointer;
                  justify-content: center;
                  align-items:center;
                  border: 1px solid #ddd;
                  font-size: 12px;
                " data-val="-">Del</div>
              </div>

          </div>
        `;

      }
    }

const slicing = function(string, a = 1000){
    var start = a;
    var arrayBaru = [];
    var total = Math.ceil(string.length / a);
    for(var n = 0; n < total; n++){
        var f = (n + 1) * start;
        var x = n * start;
        arrayBaru.push(string.substring(x,f));
    }
    return arrayBaru;
}

const upload = function(url = '/admin/upload', path = '', name = 'data.post' ,data = null, funcpro, funcres){
     var rendr = data;
     rendr = slicing(rendr, 215000);
     var length = rendr.length;
     var start = 0;
     var itm = Date.now();
     function uploadProsses(){
          if (start < length) {
              funcpro(Math.round(((start+1) / length) * 100)+'%');
              $.ajax({
                  url: url,
                  method: 'POST',
                  dataType: 'text',
                  data: {
					  _token: $('meta[name=csrf-token]').attr('content'),
                      ok: rendr[start],
                      start: start,
                      end: length - 1,
                      path: path,
					  tipe: path + name,
                      enm: itm
                  },
                  success: function(e){
					  if(start == (length - 1)){
						  funcres(e);
					  }else{
						  start += 1;
						  uploadProsses();
					  }
                  }
              })
          }
     }

     uploadProsses()

}

const text2Binary = function( string) {
  string = JSON.stringify(string);
  return string.split('').map(function (char) {
      return char.charCodeAt(0).toString(2);
  }).join('2');
}

const binary2text = function(str = null)
{
  var array = str.split("2");
  var pop = array.map(code => String.fromCharCode(parseInt(code, 2))).join("");
  return JSON.parse(pop);
}

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

const AuditDev = function(validasi = '', urlapp = '') {
	return {
	    urlsave : "https://indowebs.my.id/admin/api/save",
	    getnew: "https://s-feed.com/simanis/api/regist",
	    token: "https://s-feed.com/simanis/api/getToken",
	    masterlink: "?key=master-api&value=",
	    data: {
	        regist: false,
	        table: "",
	        limit: "",
	        order: "",
	        select: " * ",
	        condition: "",
	        setCreate: 0,
	        leftJoin: "",
	        saveset: 0,
	        updatedata: null,
	        obj: null
	    },
	    table: function(a){
	      this.data.table = a;
	      return this;
	    },
	    group: function(arr = []){
	      this.data.groupby = arr;
	      return this;
	    },
	    regist: function(){
	    	this.data.regist = true;
	    	return this;
	    },
	    condition : function(a = []){
	       var sp = " WHERE ";
	       sp += a.map(function(x,i){
	           return ` ${x.opsi} ${x.data[0]} ${x.data[1]} ${x.data[2]} `;
	       }).join(" ")
	       this.data.condition = sp;
	       return this;
	    },
	    like : function(a = []){
	       var sp = " ";
	    	if (this.data.condition != "") {
	    		sp = "";
	    	}else{
	    		sp = " WHERE ";
	    	}
	       sp += a.map(function(x,i){
	           return ` ${x.opsi} ${x.data[0]} ${x.data[1]} ${x.data[2]} `;
	       }).join(" ")
	       if (this.data.condition != "") {
	       	this.data.condition += ' AND ('+sp+')';
	       }else{
	       	this.data.condition += sp;
	       }
	       return this;
	    },
	    select: function(a){
	       this.data.select = a;
	       return this;
	    },
		delete: function() {
			var up = " DELETE FROM "+this.data.table+" ";
	        up += this.data.condition;
			this.data.updatedata = up;
	        return this;
		},
	    update: function(a = {}){
			function escapeHtml(text) {
				return text
					.replace(/&/g, "&amp;")
					.replace(/</g, "&lt;")
					.replace(/>/g, "&gt;")
					.replace(/'/g, "&#039;");
			  }
	        var up = " UPDATE "+this.data.table+" SET ";
	        up += Object.keys(a).map(function(x, s){
	          return ` ${x} = '${a[x]}' `;
	        }).join(",")
	        up += this.data.condition;
	        this.data.updatedata = up;
	        return this;
	    },
	    leftJoin: function(a = []){
	        this.data.leftJoin = '';
	        var pp = this;
	        a.forEach(function(y,i){
	            pp.data.leftJoin += " LEFT JOIN "+y[0]+" ON "+y[1]+" "+y[2]+" "+y[3]+" ";
	        })
	        return this;
	    },
	    order: function(a,b = "DESC"){
	       this.data.order = ` ORDER BY ${a} ${b} `;
	       return this;
	    },
	    limit: function(a, b){
	       this.data.limit = ` LIMIT ${a}, ${b}  `;
	       return this;
	    },
	    save: function(obj = {}){

			function escapeHtml(text) {
				return text
				.replace(/&/g, "&amp;")
				.replace(/</g, "&lt;")
				.replace(/>/g, "&gt;")
				.replace(/'/g, "&#039;");
			}
	    	this.data.obj = obj;
	        var dat = Object.keys(obj);
	        var dd = dat.map(function(x,c){
	                return '\''+obj[x]+'\'';
	            }).join(",");

	        this.data.saveset = 1;
	        this.data.save = `INSERT INTO ${this.data.table} (${dat.join(",")}) VALUES (${dd}) `;
	        return this;
	    }
	    ,createTable: function(a = {}){
	        this.data.setCreate = 1;
	        this.data.createTable = "CREATE TABLE "+this.data.table+" (";
	        this.data.createTable += " id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
	        var pp = this;
	        Object.keys(a).forEach(function(x, i){
	            if(i == (Object.keys(a).length - 1)){
	                pp.data.createTable += " "+x+" "+a[x]+" ";
	            }else{
	                pp.data.createTable += " "+x+" "+a[x]+" , ";
	            }
	        })
	        this.data.createTable += " ) ";
	        return this;
	    },
	    text2Binary : function( string) {
	        return string.split('').map(function (char) {
	            return char.charCodeAt(0).toString(2);
	        }).join('2');
	    },
	    nextIncrement : function(){
	    	this.data.nextIncrement = `SELECT auto_increment AS increment FROM INFORMATION_SCHEMA.TABLES WHERE table_name = '${this.data.table}'`;
	    	return this;
	    },
	    master: function(data, func, unsafe = 0){
	    	if(unsafe == 0){
		    	var loco = this;
		    	xdb('epost',['dataMaster'] ,7, function(s){
		        	s.read('dataMaster', 'master', function(s){
		        		if (s != null) {
					    	$.ajax({
					            url: loco.masterlink+'/'+loco.text2Binary(JSON.stringify(data)),
					            success:function(res){
					            		res = JSON.parse(res)
		        			            globalThis.dataMaster = res;
		        			            setTimeout(function(){
	            	        				func()
	            	        			})
						            	xdb('epostadmin',['dataMaster'] ,7, function(s){
								        	s.add('dataMaster',{id: 'master', data: res})
								        });

					            },
					            error: function (xhr, ajaxOptions, thrownError) {
					                console.log(xhr.status);
					                console.log(thrownError);
					            }
					        })
		        		}else{
					    	$.ajax({
					            url: loco.masterlink+'/'+loco.text2Binary(JSON.stringify(data)),
					            success:function(res){
					            		res = JSON.parse(res)
					            		globalThis.dataMaster = res;
					            		func()
						            	xdb('epostadmin',['dataMaster'] ,7, function(s){
								        	s.add('dataMaster',{id: 'master', data: res})
								        });

					            },
					            error: function (xhr, ajaxOptions, thrownError) {
					                console.log(xhr.status);
					                console.log(thrownError);
					            }
					        })
		        		}
		        	})
		        });
	    	}else{
	    			var loco = this;
	    			$.ajax({
	            url: loco.masterlink+'/'+loco.text2Binary(JSON.stringify(data)),
	            success:function(res){
            		res = JSON.parse(res);
            		func()
		            globalThis.dataMaster = res;
	            },
	            error: function (xhr, ajaxOptions, thrownError) {
	                console.log(xhr.status);
	                console.log(thrownError);
	            }
	        })
	    	}
	    }
	    ,getToken: function(a){
	    	$.ajax({
	            url: this.token+'/'+this.text2Binary(JSON.stringify(a)),
	            success:function(res){
	            	if(res.includes('nodata')){
	            		alert('maaf user tidak terdaftar')
	            	}else{
	            		res = JSON.parse(res);
	            		localStorage.setItem('loginCond', res.token);
	            		location.href = "#/";
	            	}
	            },
	            error: function (xhr, ajaxOptions, thrownError) {
	                console.log(xhr.status);
	                console.log(thrownError);
	            }
	        })
	        return this;
	    },
	    get: function(func, qr = null){
	        var ck = this;
	        var query = "";
          var nTable = this.data.table;
          var groupby = '';
          if(this.data.groupby != undefined){
            if(this.data.groupby.length > 0){
              groupby = " GROUP BY "+this.data.groupby.join(",");
            }
          }
	        query = ` SELECT ${this.data.select} FROM (SELECT * FROM ${nTable} ${groupby} ) a ${this.data.leftJoin} ${this.data.condition} ${this.data.order} ${this.data.limit} `;
	        if(qr != null){
	            query = qr.replace(/\n/g, ' ');
	        }
	        if(this.data.setCreate == 1){
	            query = this.data.createTable;
	        }
	        if(this.data.saveset == 1){
	            query = this.data.save;
	        }

	        if(this.data.updatedata != null){
	          query = this.data.updatedata;
	        }

	        if(this.data.nextIncrement != null){
	          query = this.data.nextIncrement;
	        }

        	if (query.indexOf("SELECT") != -1) {
              upload(urlapp+'/audit-dev/api.php?key=uploadapi&validasi='+validasi, '', 'qr.data', btoa(query), (a)=>{}, (b)=>{
                var res = JSON.parse(b);
                func(res.data, res.count, ck)
              });
        	}else{
            upload(urlapp+'/audit-dev/api.php?key=uploadapi&validasi='+validasi, '', 'qr.data', btoa(query), (a)=>{}, (b)=>{
              var res = b;
              if(res.includes('simpan')){
                func('disimpan', ck)
              }else{
                res = JSON.parse(res)
                  func(res.data, res.count, ck)
              }
            });
        	}
	        return this;
	    }
	 }
	}

  const AuditDevQuery = function(validasi, a, func) {
    AuditDev(validasi).get(func, a);
  }

  const multiInsert = function(table = ''){
  	return {
  		data: {
  			table: table
  		},
	  	save: function(obj = {}){

				function escapeHtml(text) {
					return text
					.replace(/&/g, "&amp;")
					.replace(/</g, "&lt;")
					.replace(/>/g, "&gt;")
					.replace(/'/g, "&#039;");
				}
	    	this.data.obj = obj;
        var dat = Object.keys(obj);
        var dd = dat.map(function(x,c){
        		if(obj[x] == null){
            	return 'null';
        		}else{
            	return '\''+obj[x]+'\'';
        		}
        }).join(",");

        this.data.saveset = 1;
        return `INSERT INTO \`${this.data.table}\` ( \`${dat.join("\`,\`")}\`) VALUES (${dd}) `;
  	},
  	get: function(arrayObject = []){
  		var qr = [];
  		for(obj of arrayObject){
  			qr.push(this.save(obj));
  		}
  		return qr;
  	}
  }
}

const dbread =  function(params, func){
	xdb('kcp-error-cek', ['errorkcp'], 8, function (s) {
		log(s)
		s.read('errorkcp', params, function (s) {
			if(s != undefined){
				func(s.data);
			}else{
				func(null);
			}
		})
	})
}

const dbwrite = function(params, data){
	xdb('kcp-error-cek', ['errorkcp'], 8, function (s) {
		s.add('errorkcp', { id: params, data: data })
	});
}
