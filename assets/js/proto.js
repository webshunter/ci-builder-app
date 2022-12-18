const timestamp = function(){
    var since = new Date();
    function pad(number) {
      if ( number < 10 ) {
        return '0' + number;
      }
      return number;
    }
    return pad(since.getFullYear()) + '-' + pad(since.getMonth()+1) + '-' + pad(since.getDate()) + ' ' + pad(since.getHours()) + ':' + pad(since.getMinutes()) + ':' + pad(since.getSeconds());
  }

  function alert(a){
      var idAlert = 'alert-'+Date.now();
      var alertDoc = div()
          .css('position', 'fixed')
          .css('width', '100vw')
          .css('height', '100vh')
          .css('background', 'rgba(0,0,0,0.8)')
          .css('z-index', '99999')
          .css('top', '0')
          .css('left', '0')
          .id(idAlert)
          .css('text-align', 'center')
          .click(function(event){
              var close = event.target;
              var cek = close.getAttribute('panel-alert')
              if(cek == undefined){
                  close.remove();
              }
          })
          .child(
              div()
              .css('display', 'inline-block')
              .padding('14px')
              .attr('panel-alert', true)
              .background('#fff')
              .color('#333')
              .css('margin-top', '20px')
              .css('max-width', '320px')
              .css('width', '320px')
              .radius('8px')
              .radius('8px')
              .child(
                  p().margin(0).css('text-align', 'left').color('#333').text(a).attr('panel-alert', true)
              )
              .child(
                  div().attr('panel-alert', true).css('text-align', 'right').child(
                      btn().text('ok').size('18px')
                      .css('outline', 'none')
                      .css('border', 'none')
                      .attr('panel-alert', true)
                      .addModule('idAlert', idAlert)
                      .css('background', 'transparent')
                      .cursor('pointer')
                      .click(function(event){
                          globalThis[event.target.idAlert].parent.remove();
                      })
                  )
              )
          )
      document.body.appendChild(alertDoc.get());
      var result;
      try {
          result = eval(`throw 'alert! ${a}';`);
      } catch (ex) {
          if (ex !== null && typeof ex !== "undefined") {
              if (ex.message) ex = ex.message;
          } else {
              ex = "An unknown error occurred.";
          }
          result = ex;
      }
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

  String.prototype.FirstUpper = function(){
    var val = this.toLowerCase();
    return val.charAt(0).toUpperCase() + val.slice(1);
  }

  String.prototype.number = function(fn = false){
      var s = this;
      if(fn == 2){
          s = s.replace(/\./g, ',');
      }
      if(fn != 2){
        s = s.replace(/[^-,\d]/g, '');
      }
      if(s == null){
          s = '0';
      }
      if(fn == false){
        if(s == '-'){
          return '-';
        }else if(s == ''){
            return '';
        }else{
          return Number(s.replace(/\./g,'').replace(/\,/g,'.'));
        }
      }else if(fn == true){
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

  String.prototype.Upper = function(){
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

  String.prototype.parse = function(){
      return JSON.parse(this);
  }

  String.prototype.textonly = function(){
      return this.replace(/[^a-zA-Z]+/g, '');
  }

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

  const scroller = function(container) {
      const ele = document.getElementById(container);
      ele.style.cursor = 'grab';

      let pos = { top: 0, left: 0, x: 0, y: 0 };

      const mouseDownHandler = function (e) {
          ele.style.cursor = 'grabbing';
          ele.style.userSelect = 'none';

          pos = {
              left: ele.scrollLeft,
              top: ele.scrollTop,
              // Get the current mouse position
              x: e.clientX,
              y: e.clientY,
          };

          document.addEventListener('mousemove', mouseMoveHandler);
          document.addEventListener('mouseup', mouseUpHandler);
      };

      const mouseMoveHandler = function (e) {
          // How far the mouse has been moved
          const dx = e.clientX - pos.x;
          const dy = e.clientY - pos.y;

          // Scroll the element
          ele.scrollTop = pos.top - dy;
          ele.scrollLeft = pos.left - dx;
      };

      const mouseUpHandler = function () {
          ele.style.cursor = 'grab';
          ele.style.removeProperty('user-select');

          document.removeEventListener('mousemove', mouseMoveHandler);
          document.removeEventListener('mouseup', mouseUpHandler);
      };

      // Attach the handler
      ele.addEventListener('mousedown', mouseDownHandler);
  }

  // proto element

  const ConfScrollDown = function(element){
      element.__proto__.down = function(){
          this.scrollTop = (this.scrollHeight - this.clientHeight);
          return this;
      }
  }

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

  const ConfStyle = function(element){
      element.__proto__.inputRupiah = function(){
          this.addEventListener('keyup', function(){
              if(this.value != ''){
                  this.value = this.value.lastDotToComa().number(true).currency();
              }
          },false)
          return this;
      }
      element.__proto__.displayFlex = function(){
          this.style.display = 'flex';
          return this;
      }
      element.__proto__.displayInlineFlex = function(){
          this.style.display = 'inline-flex';
          return this;
      }
      element.__proto__.displayInlineBlock = function(){
          this.style.display = 'inline-block';
          return this;
      }
      element.__proto__.displayBlock = function(){
          this.style.display = 'block';
          return this;
      }
      element.__proto__.displayInline = function(){
          this.style.display = 'inline';
          return this;
      }
      element.__proto__.displayGrid = function(){
          this.style.display = 'grid';
          return this;
      }
      element.__proto__.displayNone = function(){
          this.style.display = 'none';
          return this;
      }
      element.__proto__.maxHeight = function(number){
          this.style.maxHeight = number+'px';
          return this;
      }
      element.__proto__.h = function(number){
          if(number != undefined){
              this.style.height = number+'px';
              return this;
          }else{
              return this.clientHeight;
          }
      }
      element.__proto__.setH100 = function(element){
          if(element != undefined){
              this.style.height = 'calc(100vh - '+(element.clientHeight)+'px)';
              return this;
          }else{
              this.style.height = 'calc(100vh)';
              return this;
          }
      }
  }

    Object.defineProperty(Array.prototype, 'orderBy', {
      value: function(sorts) {
        sorts.map(sort => {
          sort.uniques = Array.from(
            new Set(this.map(obj => obj[sort.key]))
          );

          sort.uniques = sort.uniques.sort((a, b) => {
            if (typeof a == 'string') {
              return sort.inverse ? b.localeCompare(a) : a.localeCompare(b);
            } else if (typeof a == 'number') {
              return sort.inverse ? b - a : a - b;
            } else if (typeof a == 'boolean') {
              let x = sort.inverse ? (a === b) ? 0 : a ? -1 : 1 : (a === b) ? 0 : a ? 1 : -1;
              return x;
            }
            return 0;
          });
        });

        const weightOfObject = (obj) => {
          let weight = "";
          sorts.map(sort => {
            let zeropad = `${sort.uniques.length}`.length;
            weight += sort.uniques.indexOf(obj[sort.key]).toString().padStart(zeropad, '0');
          });
          //obj.weight = weight; // if you need to see weights
          return weight;
        }

        this.sort((a, b) => {
          return weightOfObject(a).localeCompare(weightOfObject(b));
        });

        return this;
      }
    });

    function viewLaporan(){
      document.body.className = 'sidebar-collapse';
      document.querySelector('nav').style.display = 'none';
      document.querySelector('.wrapper > div').style.minHeight = 'auto'
    }

    function formatRupiah(angka, prefix) {
      var topHead = "";
      if (angka.toString()[0] == "-") {
        topHead = "-";
      }

      var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
      }
      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      rupiah = topHead + rupiah;
      return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
    }

    $.fn.vall = function(a = 0) {
      a = Number(a);
      var id = this.attr('id').replace(/\]/g, "b").replace(/\[/g, "a")
      var ids = '#' + id + '_nbr4';
      $("#" + id).val(a);
      var s = a.toFixed(2);
      s = s + '';
      s = s.replace(/\./g, ',');
      $(ids).val(formatRupiah(s));
      return this;
    }

    $.fn.valh = function(a = 0) {
      a = Number(a);
      var id = this.attr('id').replace(/\]/g, "b").replace(/\[/g, "a")
      var ids = '#' + id + '';
      var s = a.toFixed(2);
      s = s + '';
      s = s.replace(/\./g, ',');
      $(ids).html(formatRupiah(s));
      return this;
    }

    function setVal(id, val) {
      var id = id.replace(/\]/g, "b").replace(/\[/g, "a");
      $("#" + id).vall(val);
    }

    function getVal(id) {
      var id = id.replace(/\]/g, "b").replace(/\[/g, "a")
      return Number($("#" + id).val());
    }

    function getVall(id) {
      var id = id.replace(/\]/g, "b").replace(/\[/g, "a")
      return Number($("#" + id + '_nbr4').val());
    }

    function getId(id) {
      return id.replace(/\]/g, "b").replace(/\[/g, "a");
    }

    function delay(callback, ms) {
      var timer = 0;
      return function() {
        var context = this,
          args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function() {
          callback.apply(context, args);
        }, ms || 0);
      };
    }

    $.fn.numKeyUp = function(func) {
      var id = this.attr('id').replace(/\]/g, "b").replace(/\[/g, "a")
      var ids = '#' + id + '_nbr4';

      $(document).on("keyup", ids, delay(function() {

        func($("#" + id).val(), $(this))

      }, 500))
    }

    function numKeyUp(id, func) {
      var id = id.replace(/\]/g, "b").replace(/\[/g, "a")
      var ids = '#' + id;
      $(ids).numKeyUp(func);
    }

    function clearTd(id) {
      $(document).on('click', '#' + id, function() {
        $("#td-" + id).remove();
      })
    }

    $.fn.select2Change = function(a = '') {
      var id = this.attr('id').replace(/\]/g, "b").replace(/\[/g, "a")
      var ids = this.attr('id').replace(/\]/g, "b").replace(/\[/g, "a") + '-readonly';

      $("#" + ids).val(a);

      var c = $("#" + ids).val();

      $("#" + id).val(a);
      $("#" + id).select2().trigger('change');
      return this;
    }

    function sum(arr = []){
      const sum = arr.reduce((partialSum, a) => partialSum + a, 0);
      return sum;
    }

    Node.prototype.clear = function(){
      if(document.querySelector('aside') != undefined){
        document.querySelector('aside').remove();
      }
      document.body.className = ''
      if(document.querySelector('.wrapper .content-wrapper') != undefined){
        document.querySelector('.wrapper .content-wrapper').className = ''
      }
      if(document.querySelector('.wrapper nav') != undefined){
        document.querySelector('.wrapper nav').remove()
      }
    }

    var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
      , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
      , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
      , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
      return function(table, name) {
        var ctx = {worksheet: name || 'Worksheet', table: table}
        window.location.assign(uri + base64(format(template, ctx)))
      }
  })();

  function PrintElemS(elem, size = '292mm 210mm ')
    {
        var mywindow = window.open('', 'PRINT', 'height='+window.outerHeight+',width='+window.outerWidth);

        mywindow.document.write('<html moznomarginboxes mozdisallowselectionprint><head><title>' + document.title  + '</title>');
        mywindow.document.write(`<style>
          @media print {
            @page {
              margin: 0;
              size: ${size} ;
            }
            body { margin: 0; }
            *{
                padding:0;
                margin:0;
                font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            }

            table{
              border-collapse: collapse;
            }
          }
          table{
            border-collapse: collapse;
          }
          </style>`);
        mywindow.document.write('</head><body >');
        console.log(elem)
        mywindow.document.write(elem);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }

  function PreviewsElement(elem, size = '292mm 210mm ')
    {
        var mywindow = window.open('', 'PRINT', 'height='+window.outerHeight+',width='+window.outerWidth);

        mywindow.document.write('<html moznomarginboxes mozdisallowselectionprint><head><title>' + document.title  + '</title>');
        mywindow.document.write(`<style>
          @media print {
            @page {
              margin: 0;
              size: ${size} ;
            }
            body { margin: 0; }
            *{
                padding:0;
                margin:0;
                font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            }

            table{
              border-collapse: collapse;
            }
          }
          table{
            border-collapse: collapse;
          }
          </style>`);
        mywindow.document.write('</head><body >');
        console.log(elem)
        mywindow.document.write(elem);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        return true;
    }

    function printButton(content = '') {
      document.body.clear();
      if(globalThis.printContainer != undefined){
        globalThis.printContainer.remove();
      }
      globalThis.printContainer = div()
      printContainer.load(function(e){
        globalThis.printContainer = e.el;
      })
      printContainer.child(
        el('FORM').attr('action', '/home/pdf').attr('method', 'post')
        .child(
          textarea().name('content').html(content).css('display', 'none')
          )
          .child(
            btn()
            .css({
              outline: 'none',
              border: 'none',
              background: 'transparent'
            })
            .type('button')
            .addModule('content', content)
            .click(function(){
              var content = this.content;
              PrintElemS(content);
              // upload('<?= site_url('') ?>home/uploadlap','','datalap', btoa(content),function(){},function(s){
              //   loaders.remove();
              //   location.href = "<?= site_url('') ?>home/pdf/"+s;
              // })
            })
            .child(
              i().class('fas fa-file-pdf')
              .css('position', 'fixed')
              .css('bottom', '70px')
              .css('right', '20px')
              .css('font-size', '16px')
              .css('padding', '15px')
              .css('border-radius', '50%')
              .css('background', '#99F')
              .css('color', '#fff')
              .css('width', '50px')
              .css('height', '50px')
              .css('display', 'flex')
              .css('justify-content', 'center')
              .css('align-items', 'center')
              .css('box-shadow', '0 0 10px #777')
            )
          )
        )
      printContainer.child(
        el('FORM').attr('action', '/home/excel').attr('method', 'post')
        .child(
          textarea().name('content').html(content).css('display', 'none')
          )
          .child(
            btn()
            .css({
              outline: 'none',
              border: 'none',
              background: 'transparent'
            })
            .addModule('content', content)
            .type('button')
            .click(function(){
              var content = this.content;
              console.log(content);
              
              tableToExcel(content, 'export laporan');
              // upload('<?= site_url('') ?>home/uploadlap','','datalap', btoa(content),function(){},function(s){
              //   loaders.remove();
              //   console.log(s)
              //   location.href = "<?= site_url('') ?>home/excel/"+s;
              // })
            })
            .child(
              i().class('fas fa-file-excel')
              .css('position', 'fixed')
              .css('bottom', '130px')
              .css('right', '20px')
              .css('font-size', '16px')
              .css('padding', '15px')
              .css('border-radius', '50%')
              .css('background', '#99F')
              .css('color', '#fff')
              .css('width', '50px')
              .css('height', '50px')
              .css('display', 'flex')
              .css('justify-content', 'center')
              .css('align-items', 'center')
              .css('box-shadow', '0 0 10px #777')
            )
          )
        )
        globalThis.printButtonActive = printContainer;
        document.body.appendChild(printContainer.get());

    }


    function rp(a){
      return 'Rp '+formatRupiah(Number(a).toFixed(2).replace(/\./g, ','))
    }

    const ip_public = '<?= ip() ?>';

    String.prototype.textnumber = function(){
        return this.textonly()+this.replace(/\ /g,'').replace(/\-/g, '').number();
    }

    Array.prototype.CreatePanelCard = function(name=''){

          var arr = this.map(function(y,i){
              if(i == 0){
                  return `<li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-${y[name].textnumber()}-tab" data-toggle="pill" href="#custom-tabs-one-${y[name].textnumber()}" role="tab" aria-controls="custom-tabs-one-${y[name].textnumber()}" aria-selected="true">${y[name]}</a>
                          </li>`;
              }else{
                  return `<li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-${y[name].textnumber()}-tab" data-toggle="pill" href="#custom-tabs-one-${y[name].textnumber()}" role="tab" aria-controls="custom-tabs-one-${y[name].textnumber()}" aria-selected="true">${y[name]}</a>
                          </li>`;
              }
          }).join('')

          var arrd = this.map(function(y,i){
              if(i == 0){
                  return `<div class="tab-pane fade show active" id="custom-tabs-one-${y[name].textnumber()}" role="tabpanel" aria-labelledby="custom-tabs-one-${y[name].textnumber()}-tab">
                         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                      </div>`;
              }else{
                  return `<div class="tab-pane fade" id="custom-tabs-one-${y[name].textnumber()}" role="tabpanel" aria-labelledby="custom-tabs-one-${y[name].textnumber()}-tab">
                         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                      </div>`;
              }
          }).join('')


          var data = this.map(function(y,i){
              var dh = {}
              dh[y[name]] = 'custom-tabs-one-'+y[name].textnumber()
              return dh;
          })

          return {
                data : data,
                content : `
                    <div class="card card-primary card-tabs">
                      <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab-${name}" role="tablist">
                          ${arr}
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent-${name}">
                          ${arrd}
                        </div>
                      </div>
                    </div>
                `
            }

      }



// modal combinn with form
      const openModalForm = function(idmodalopen = 'simple-modal', buttonName = 'ongkir', data = [{
        kontak : '00',
        total: 1000
      },{
        kontak : '01',
        total: 2000
      }], supplier = [
        {
          id: '00',
          nama_panggilan: 'Dinos',
        },
        {
          id: '01',
          nama_panggilan: 'Dinos 2',
        }
      ], func = undefined){

        var idf = Date.now();


        function formatRupiah(angka, prefix) {

          var topHead = "";

          if(Number.isInteger(angka)){
            angka = angka.toString();
          }

          if (angka.toString()[0] == "-") {
            topHead = "-";
          }


          var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
          // tambahkan titik jika yang di input sudah menjadi angka ribuan
          if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
          }
          rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
          rupiah = topHead + rupiah;
          return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";

        }

        globalThis.makeclearform = function(sup){
          sup = JSON.parse(atob(sup))
          function selection(){
            return sup.map(function(a, b){
              return `
                <option value="${a.id}">${a.nama_panggilan}</option>
              `;
            }).join('')
          }

          var id = Date.now();

          var s = document.createElement('SELECT')
          s.className = 'select2'
          s.id = 'sel-'+id;
          s.setAttribute('data-name-ongkir-select', true);
          s.innerHTML = selection();
          s.name = "ongkir[{c}}][kontak]";
          s.load = function(){
            $("#"+this.id).select2()
          }

          var dv = document.createElement('DIV')
          dv.func = func;
          dv.style.display = 'grid';
          dv.style.gridTemplateColumns = 'auto';
          dv.appendChild(s);

          var dvi = document.createElement('DIV')
          dvi.style.display = 'grid';
          dvi.style.gridTemplateColumns = 'auto';


          var inpt2 = document.createElement('INPUT');
          inpt2.type = "hidden";
          inpt2.name = "ongkir[{c}}][total]";
          inpt2.setAttribute('data-name-ongkir-input', true);

          var inpt = document.createElement('INPUT')
          inpt.value = '';
          inpt.id = 'inpt-'+id;
          inpt.rp = formatRupiah
          inpt.Vid = inpt2;
          inpt.func = func;
          inpt.onkeyup = function(){
            this.value = this.rp(this.value)
            this.Vid.value = this.value.replace(/\./g, '').replace(/\,/g, '.');

            if(this.func != undefined){
              var tot = 0;
              Array.from(document.querySelectorAll('[data-name-ongkir-input]')).forEach(function(j,i){
                tot += Number(j.value);
              })
              this.func(tot);
            }

          }

          dvi.appendChild(inpt2)
          dvi.appendChild(inpt)

          var cls = document.createElement('BUTTON')
          cls.innerText = 'x';
          cls.type = 'button';
          cls.id = 'cls-'+id;
          cls.elSelect = dv;
          cls.elInput = dvi;
          cls.elBtn = cls;
          cls.func = func;
          cls.onclick = function(){
            this.elSelect.remove()
            this.elInput.remove()
            this.elBtn.remove()
            if(this.func != undefined){
              var tot = 0;
              Array.from(document.querySelectorAll('[data-name-ongkir-input]')).forEach(function(j,i){
                tot += Number(j.value);
              })
              this.func(tot);
            }
          }

          document.getElementById('form-ongkir-'+idf).appendChild(dv)
          document.getElementById('form-ongkir-'+idf).appendChild(dvi)
          document.getElementById('form-ongkir-'+idf).appendChild(cls)

          setTimeout(function(){
            s.load()

            if(dv.func != undefined){
              var tot = 0;
              Array.from(document.querySelectorAll('[data-name-ongkir-input]')).forEach(function(j,i){
                tot += Number(j.value);
              })
              dv.func(tot);
            }

            Array.from(document.querySelectorAll('[data-name-ongkir-select]')).forEach(function(j,i){
              j.name = `ongkir-data[${i}][kontak]`
            })

            Array.from(document.querySelectorAll('[data-name-ongkir-input]')).forEach(function(j,i){
              j.name = `ongkir-data[${i}][total]`
            })
          })

        }


        function makeform(data, sup){
          function selection(id){
            return sup.map(function(a, b){
              if(a.id == id){
                return `
                  <option selected value="${a.id}">${a.nama_panggilan}</option>
                `;
              }else{
                return `
                  <option value="${a.id}">${a.nama_panggilan}</option>
                `;
              }
            }).join('')
          }
          var html = ``;
          var c = 0;
          var id = Date.now();
          if(globalThis.FormOngkir == undefined){
            globalThis.FormOngkir = {}
          }
          for(var g of data){
            var s = document.createElement('SELECT')
            s.className = 'select2'
            s.id = 'sel-'+id+'-'+c;
            s.load = function(){
              $("#"+this.id).select2()
            }
            s.setAttribute('data-name-ongkir-select', true);
            s.innerHTML = selection(g.kontak);
            s.name = "ongkir[{c}][kontak]";
            FormOngkir['sel-'+id+'-'+c] = s;

            var dv = document.createElement('DIV')
            dv.style.display = 'grid';
            dv.style.gridTemplateColumns = 'auto';
            dv.appendChild(s);

            var dvi = document.createElement('DIV')
            dvi.style.display = 'grid';
            dvi.style.gridTemplateColumns = 'auto';

            var inpt2 = document.createElement('INPUT');
          inpt2.type = "hidden";
          inpt2.name = "ongkir[{c}}][total]";
          inpt2.setAttribute('data-name-ongkir-input', true);

          var inpt = document.createElement('INPUT')
          inpt.value = '';
          inpt.id = 'inpt-'+id;
          inpt.rp = formatRupiah
          inpt.Vid = inpt2;
          inpt.func = func;
          inpt.onkeyup = function(){
            this.value = this.rp(this.value)
            this.Vid.value = this.value.replace(/\./g, '').replace(/\,/g, '.');

            if(this.func != undefined){
              var tot = 0;
              Array.from(document.querySelectorAll('[data-name-ongkir-input]')).forEach(function(j,i){
                tot += Number(j.value);
              })
              this.func(tot);
            }

          }

            dvi.appendChild(inpt2)
            dvi.appendChild(inpt)

            inpt2.value = g.total
            inpt.value = formatRupiah(g.total)

            var cls = document.createElement('BUTTON')
            cls.innerText = 'x';
            cls.type = 'button';
            cls.id = 'cls-'+id+'-'+c;
            cls.elSelect = dv;
            cls.elInput = dvi;
            cls.elBtn = cls;
            cls.func = func;
            cls.onclick = function(){
              this.elSelect.remove()
              this.elInput.remove()
              this.elBtn.remove()
              if(this.func != undefined){
                var tot = 0;
                Array.from(document.querySelectorAll('[data-name-ongkir-input]')).forEach(function(j,i){
                  tot += Number(j.value);
                })
                this.func(tot);
              }
            }
            document.getElementById('form-ongkir-'+idf).appendChild(dv)
            document.getElementById('form-ongkir-'+idf).appendChild(dvi)
            document.getElementById('form-ongkir-'+idf).appendChild(cls)
            c++;
          }

          Object.keys(FormOngkir).forEach(function(el, i){
            FormOngkir[el].load();
          })

          Array.from(document.querySelectorAll('[data-name-ongkir-select]')).forEach(function(j,i){
            j.name = `ongkir-data[${i}][kontak]`
          })

          Array.from(document.querySelectorAll('[data-name-ongkir-input]')).forEach(function(j,i){
            j.name = `ongkir-data[${i}][total]`
          })

          if(func != undefined){
            var tot = 0;
            Array.from(document.querySelectorAll('[data-name-ongkir-input]')).forEach(function(j,i){
              tot += Number(j.value);
            })
            func(tot);
          }

        }

        var temp = `

        <div class="form-group">
          <label>${buttonName}</label>
          <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"></i> Tambah Data
          </button>
        </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">${buttonName}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
              <div id="form-ongkir-${idf}" style="display: grid; grid-template-columns: 50% auto 20px;">
              </div>
            <div class="text-center">
            <button onclick="makeclearform('${btoa(JSON.stringify(supplier))}')" type="button" class="btn btn-primary w-100">Tambah</button>
          </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
        `
        document.getElementById(idmodalopen).innerHTML = temp;
        makeform(data, supplier)
      }

  const createTable = function(arrayObject = [], alias = {}, custome = {}, style = {}, funch = null, unprint = 0, startfrom = 0){
    const AppLib = function(el) {
        var obj = {}
        if (typeof el == 'object') {
            obj.el = el;
        } else {
            obj.el = document.createElement(el);
        }
        obj.ch = [];
        obj.id = function (a) {
            this.el.id = a;
            globalThis[a] = {
                parent: this.el,
                el: globalThis.el(this.el),
                child: function (a) {
                    return this.parent.appendChild(a.get())
                }
            }
            return this;
        }
        obj.text = function (a) {
            this.el.className += ' disable-selection ';
            this.el.innerText = a;
            return this;
        }
        obj.html = function (a) {
            this.el.innerHTML = a;
            return this;
        }
        obj.name = function (a) {
            this.el.setAttribute('name', a);
            return this;
        }
        obj.href = function (a) {
            this.el.setAttribute('href', a);
            return this;
        }
        obj.val = function (a) {
            this.el.value = a;
            return this;
        }
        obj.css = function (a, b) {
            if (typeof a == "object") {
                var ky = Object.keys(a);
                ky.forEach(function (item) {
                    this.el.style[item] = a[item];
                }, this)
                return this;
            } else {
                this.el.style[a] = b;
                return this;
            }
        }
        obj.change = function (func) {
            this.el.addEventListener('change', func, false);
            return this;
        }
        obj.keydown = function (func) {
            this.el.addEventListener('keydown', func, false);
            return this;
        }
        obj.mouseover = function (func) {
            this.el.addEventListener('mouseover', func, false);
            return this;
        }
        obj.resize = function (func) {
            var gopy = this;
            window.addEventListener('resize', function (e) {
                width = e.target.outerWidth;
                height = e.target.outerHeight;
                var elm = {
                    el: gopy.el,
                    width: width,
                    height: height
                }
                setTimeout(function () {
                    func(elm);
                }, 100)
            }, gopy)
            return gopy;
        }
        obj.load = function (func,asr = 100) {
            var gopy = this;
            var width = window.outerWidth;
            var height = window.outerHeight;
            var elm = {
                el: gopy.el,
                width: width,
                height: height
            }
            setTimeout(function () {
                func(elm);
            }, asr)
            return gopy;
        }
        obj.mouseout = function (func) {
            this.el.addEventListener('mouseout', func, false);
            return this;
        }
        obj.keypress = function (func) {
            this.el.addEventListener('keypress', func, false);
            return this;
        }
        obj.click = function (func) {
            this.el.addEventListener('click', func, false);
            return this;
        }
        obj.submit = function (func) {
            this.el.addEventListener('submit', function (e) {
                el = e.path[0];

                el = new FormData(el);

                var object = {};
                el.forEach(function (value, key) {
                    object[key] = value;
                });
                var json = object;

                func(json)

                e.preventDefault();
            }, false);
            return this;
        }
        obj.keyup = function (func) {
            this.el.addEventListener('keyup', func, false);
            return this;
        }
        obj.size = function (a) {
            this.el.style.fontSize = a;
            return this;
        }
        obj.type = function (a) {
            this.el.setAttribute("type", a);
            return this;
        }
        obj.attr = function (a, d) {
            this.el.setAttribute(a, d);
            return this;
        }
        obj.get = function () {
            if (this.ch.length != 0) {
                this.ch.forEach(function (item) {
                    this.el.appendChild(item)
                }, this)
                return this.el;
            } else {
                return this.el;
            }
        }

        obj.child = function (a) {
            this.ch.push(a.get());
            return this;
        }


        obj.getChild = function (pop) {
            return {
                parent: this.get().children[pop],
                el: globalThis.el(this.get().children[pop]),
                child: function (a) {
                    return this.parent.appendChild(a.get())
                }
            }
        }

        obj.row = function (a) {
            var d = AppLib('DIV')
                .class('row')

            a.forEach(function (elm) {
                d.child(
                    AppLib('DIV').class(elm['class']).child(elm['content'])
                )
            }, d);
            this.ch.push(d.get());
            return this;
        }
        return obj;
    }
    var idbaru = Date.now();
    var tableBaru = AppLib('TABLE').id('table-'+idbaru)
    if(unprint == 1){
      tableBaru.css('width', '100%')
    }
    var cekCustome = Object.keys(custome).length;
    //headnametable
    tableBaru.attr('cellpadding', '8px')
    tableBaru.attr('cellspacing', 0)

    tableBaru.child(
      AppLib('THEAD').child(
        AppLib('TR').id('table-head-'+idbaru).css('border-bottom','1px solid #ddd')
      )
    )
    tableBaru.child(
      AppLib('TBODY')
      .id('table-body-'+idbaru)
    )
    arrayObject.forEach(function(a, i){
      var newTr = AppLib('TR').css('border-bottom','1px solid #ddd')
      Object.keys(a).forEach(function(g,j){
        var newTd = AppLib('td')
        .size('12pt')
        if(custome[g] != undefined){
          newTd.html(custome[g](a[g], a, newTd, newTr, startfrom, i))
        }else{
          newTd.text(a[g])
        }

        if(style[g] != undefined){
          newTd.css(style[g])
        }

        newTr.child(newTd)
      })
      globalThis['table-body-'+idbaru].child(newTr);
    })

    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

    if(arrayObject.length > 0){
      if(Object.keys(alias).length == 0){
        Object.keys(arrayObject[0]).forEach(function(a,i){
          globalThis['table-head-'+idbaru].child(
            AppLib('TH').css(style[a]).text(capitalizeFirstLetter(a.replaceAll('_', ' '))).size('12pt')
          )
        })
      }else{
        Object.keys(arrayObject[0]).forEach(function(a,i){
          if(alias[a] != undefined){
            globalThis['table-head-'+idbaru].child(
              AppLib('TH').css(style[a]).text(capitalizeFirstLetter(alias[a])).size('12pt')
            )
          }else{
            globalThis['table-head-'+idbaru].child(
              AppLib('TH').css(style[a]).text(capitalizeFirstLetter(a.replaceAll('_', ' '))).size('12pt')
            )
          }
        })
      }
    }

    if(arrayObject.length == 0){
      tableBaru = AppLib('DIV')
      .css('text-align', 'center')
      .css('font-style', 'italic')
      .text('Data belum tersedia')
    }
    var paper = AppLib('DIV').load(function(a){
      setTimeout(function(){
        if(unprint == 0){
          printButton(a.el.innerHTML);
        }
      }, 1000)
    })
    .css('min-width','100%')
    .child(tableBaru)

    var scallerDiv = AppLib('DIV')
    .id('scaller').child(paper)
    if(funch != null){
      scallerDiv.load(function(e){
        setTimeout(function(){
          funch(e);
        },100)
      })
    }

    return scallerDiv;
  }

  const insertAfter = function(newNode, existingNode) {
      if(existingNode.nextSibling != null){
        existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
      }else{
        setTimeout(function(){
          if(existingNode.parentNode != undefined){
            existingNode.parentNode.appendChild(newNode);
          }else{
            console.log(existingNode.parentElement)
            existingNode.parentElement.appendChild(newNode);
          }
        }, 500)
      }
  }

  const cssLoader = function(){
  var lod =
    div()
    .css({
      position: 'fixed',
      top: 0,
      left: 0,
      display: 'flex',
      justifyContent: 'center',
      alignItems: 'center',
      width: '100vw',
      height: '100vh',
      zIndex: '9999999',
      background: 'rgba(125,125,125,0.4)'
    })
    .child(
      el('style').html(`
        .lds-spinner {
          color: official;
          display: inline-block;
          position: relative;
          width: 80px;
          height: 80px;
        }
        .lds-spinner div {
          transform-origin: 40px 40px;
          animation: lds-spinner 1.2s linear infinite;
        }
        .lds-spinner div:after {
          content: " ";
          display: block;
          position: absolute;
          top: 3px;
          left: 37px;
          width: 6px;
          height: 18px;
          border-radius: 20%;
          background: #fff;
        }
        .lds-spinner div:nth-child(1) {
          transform: rotate(0deg);
          animation-delay: -1.1s;
        }
        .lds-spinner div:nth-child(2) {
          transform: rotate(30deg);
          animation-delay: -1s;
        }
        .lds-spinner div:nth-child(3) {
          transform: rotate(60deg);
          animation-delay: -0.9s;
        }
        .lds-spinner div:nth-child(4) {
          transform: rotate(90deg);
          animation-delay: -0.8s;
        }
        .lds-spinner div:nth-child(5) {
          transform: rotate(120deg);
          animation-delay: -0.7s;
        }
        .lds-spinner div:nth-child(6) {
          transform: rotate(150deg);
          animation-delay: -0.6s;
        }
        .lds-spinner div:nth-child(7) {
          transform: rotate(180deg);
          animation-delay: -0.5s;
        }
        .lds-spinner div:nth-child(8) {
          transform: rotate(210deg);
          animation-delay: -0.4s;
        }
        .lds-spinner div:nth-child(9) {
          transform: rotate(240deg);
          animation-delay: -0.3s;
        }
        .lds-spinner div:nth-child(10) {
          transform: rotate(270deg);
          animation-delay: -0.2s;
        }
        .lds-spinner div:nth-child(11) {
          transform: rotate(300deg);
          animation-delay: -0.1s;
        }
        .lds-spinner div:nth-child(12) {
          transform: rotate(330deg);
          animation-delay: 0s;
        }
        @keyframes lds-spinner {
          0% {
            opacity: 1;
          }
          100% {
            opacity: 0;
          }
        }
      `)
    )
    .child(
      div().class('lds-spinner')
      .html(`<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>`)
    )
    .get()
  document.body.appendChild(lod)

  return lod;

}

Array.prototype.GroupArray = function(a = [], sumNumber = []){
    var arr = this;
    var mapData = arr.map(function(o,i){
        var h = {}
            a.forEach(function(j,k){
                h[j] = o[j];
            })
        return h;
    })
    mapData = mapData.sortArrayObjectAsc(...a);
    var ji = ''
    var newD = []
    mapData.forEach(function(m,u){
        var si = '';
        a.forEach(function(n,b){
            si += m[n];
        });
        if(ji != si){
            newD.push(m);
            ji = si;
        }
    });

    newD = newD.map(function(s,v){
        var dm = arr;
        a.forEach(function(c,i){
            dm = dm.cond(s[c], c);
        });
        sumNumber.forEach(function(b,j){
            s[b] = dm.map(function(jk,l){
                return Number(jk[b]);
            }).sum();
        })
        return s;
    })

    return newD;
}

const CreateNode = el;

window.mobileCheck = function() {
  let check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
};

  const PageIframe = function(func = null){
      var idAlert = 'page-'+Date.now();
      var alertDoc = div();
          alertDoc.css('position', 'fixed')
          .css('width', '100vw')
          .css('height', '100vh')
          .css('background', 'rgba(0,0,0,0.8)')
          .css('z-index', '99999')
          .css('top', '0')
          .css('left', '0')
          .id(idAlert)
          .css('text-align', 'center')
          .child(
            btn().addModule('pageIframe', alertDoc.get()).text('X').css('position', 'fixed').top('10px').right('20px').width('50px').height('50px').size('25px').css('border-radius', '50%')
            .click(function(event){
              event.target.pageIframe.remove();
            })
          )
          .child(
            el('iframe')
            .id('views-'+idAlert)
            .width('calc(100% - 100px)')
            .height('calc(100vh - 150px)')
            .css('margin-top', '50px')
            .attr('sandbox', 'allow-forms allow-modals allow-pointer-lock allow-popups allow-same-origin allow-scripts allow-top-navigation-by-user-activation allow-downloads allow-presentation')
            .attr('referrerpolicy', 'strict-origin-when-cross-origin')
            .attr('scrolling', 'auto')
            .attr('allowtransparency', 'true')
            .attr('allowfullscreen', 'true')
            .addModule('pageIframe', alertDoc.get())
            .load(function(a){
              var pageIframe = a.el.pageIframe
              a.el.parentNode.style.height = (a.el.parentNode.clientHeight + 36)+'px';
              var win = a.el.contentWindow
              win.el = el;
              win.alert = alert;
              win.div = div;
              var doc = win.document
              a.el.document = win;
              doc.parentWindo = window;
              doc.swal = swal;
              doc.el = el;
              doc.div = div;
              doc.p = p;
              doc.tanggal = tanggal;
              doc.pageIframe = pageIframe;
              doc.datalogin = datalogin;
              doc.AuditDev = AuditDev;
              doc.AuditDevQuery = AuditDevQuery;
              doc.tableModule = table;
              doc.head.appendChild(
                el('LINK')
                .href('https://s-feed.com/assets/admin/plugins/fontawesome-free/css/all.min.css')
                .attr('rel', 'stylesheet').get()
              )
              doc.body.style.background = 'white';
              if(func != null){
                func(doc)
              }
            })
          )
      document.body.appendChild(alertDoc.get());
      var result;
      try {
          result = eval(`throw 'alert! ${a}';`);
      } catch (ex) {
          if (ex !== null && typeof ex !== "undefined") {
              if (ex.message) ex = ex.message;
          } else {
              ex = "An unknown error occurred.";
          }
          result = ex;
      }
  }

  const slicingNode = function(string, a = 1000){
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

const uploadNode = function(data = {
    path : '',
    name : 'data.json' ,
    data : 'SELECT 1+1',
    funcpro : undefined,
    funcres : undefined
}, connection = 'U2FsdGVkX19qmmBNOuNmvEQlft1Dte6w2MbL0JgybJ6+QXCTYOqqOKD+sOwSOs4PQkL0kNMAvpIhR3FDewdVZuQ8Anae+iVRPmDshq0+iEFD1U/a3P2Lx286e8fDuQN2YOixJv4zzfszMZaZ2mFGDVdXQvh74LG1eQ3xplY/+VM=', url = 'http://103.152.118.236:9992/mysql'){
     var rendr = btoa(data.data);
     rendr = slicingNode(rendr, 215000);
     var length = rendr.length;
     var start = 0;
     var itm = Date.now();
     function uploadProsses(){
          if (start < length) {
            if(data.funcpro != undefined){
                data.funcpro(Math.round(((start+1) / length) * 100)+'%');
            }
            fetch(url,{
                method: 'POST',
                headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  ok: rendr[start],
                  start: start,
                  end: length - 1,
                  connection: connection,
                  path: data.path,
                  tipe: data.path + data.name,
                  enm: itm
                })
            }).then(function(res) {
                return res.json();
            })
            .then(function(res){
                if(start == (length - 1)){
                    if(data.funcres != undefined){
                        data.funcres(res);
                    }else{
                        console.log('success')
                    }
                }else{
                    start += 1;
                    uploadProsses();
                }
            })
          }
     }
     uploadProsses()
}

const queryNode = function(query = "SELECT 1+1", res){
    uploadNode({
        path : '',
        name : 'data.json' ,
        data : query,
        funcres:function(data){
            res(data)
        }
    });
}

const cardMessage = function(id='', title = 'Pesan!'){
  var idM = 'cardMess'+tanggal().milisecond;
  var datamess = div().id(idM).padding('10px 30px').css('border-top','1px solid #ddd');
  var mess = div()
    .child(
      div()
      .class('card')
      .child(
        div().class('card-header border-transparent')
        .child(
          el('h3').class('card-title').child(
            el('i').class('fas fa-comment-alt mr-2').css('font-size', '16px')
          ).child(
            el('span')
            .text(title)
          )
        )
        .child(
          div().class('card-tools')
          .child(
            el('button').type('button').class('btn btn-tool').data('card-widget', 'collapse')
            .child(el('i').class('fas fa-minus'))
          )
          .child(
            el('button').type('button').class('btn btn-tool').data('card-widget', 'remove')
            .child(el('i').class('fas fa-times'))
          )
        )
      )
      .child(
        div().class('card-body p-0')
        .child(
          datamess
        )
      )
    )

  document.getElementById(id).appendChild(mess.get())
  return globalThis[idM];
}

const lteModal = function(title = "Modal Title"){
  var id = 'idmodal-'+Date.now();
  var body = 'idbody'+Date.now();
  var foot = div().class("modal-footer")
  .child(
    el('button').type('button').class('btn btn-secondary btn-sm').data('dismiss', 'modal').text('Tutup')
  )
  var modal =
    div().id(id).class('modal').attr('tabindex', '-1').attr('role', 'dialog')
    .child(
      div().class('modal-dialog').attr('role', 'document')
      .child(
        div().class('modal-content')
        .child(
          div().class('modal-header')
          .child(
            el('h5').class('modal-title').text(title)
          )
          .child(
            el('button').type('button').class('close').data('dismiss', 'modal').attr('aria-label', 'close')
            .child(
              el('span').attr('aria-hidden', 'true').html("&times;")
            )
          )
        )
        .child(
          div().class("modal-body").id(body)
        )
        .child(
          foot
        )
      )
    )

    document.body.appendChild(modal.get());

    return {
      id: $("#"+id),
      el: globalThis[body],
      foot: foot
    }

}

const _id = function(a){
  return document.getElementById(a);
}

const toas = function(){
  var arg = arguments;
  var dat = {
    text: '',
    duration: -1,
    destination: "",
    newWindow: true,
    close: true,
    gravity: "top", // `top` or `bottom`
    position: "right",
    offset: {
      x: 10, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
      y: 80 // vertical axis - can be a number or a string indicating unity. eg: '2em'
    }, // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
      background: "linear-gradient(to right, #00b09b, #96c93d)",
    },
    onClick: function(){} // Callback after click
  }

  if(arg[0] != undefined){
    arg = arg[0];
  }

  console.log(arg)

  if(arg.text != undefined){
    dat.text = arg.text;
  }

  if(arg.duration != undefined){
    dat.duration = arg.duration;
  }

  if(arg.duration != undefined){
    dat.duration = arg.duration;
  }

  if(arg.x != undefined){
    dat.offset.x = arg.x;
  }

  if(arg.y != undefined){
    dat.offset.y = arg.y;
  }

  if(arg.click != undefined){
    dat.onCLick = arg.click;
  }

  if(arg.background != undefined){
    dat.style.background = arg.background;
  }

  console.log(dat)

  Toastify(dat).showToast();
}

const buttonMenus = function(
    icons = "far fa-comment"
    , title = "Direct Messages"
    , sub = "163,921"
){

    var id = `button-menus-`+Date.now();

    var temp = `

        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="${icons}"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">${title}</span>
            <span class="info-box-number">${sub}</span>
            </div>
        </div>

    `;

    var t = div().html(temp).padding(0).margin(0)

    return t;

}

const getDataMenus = function(id = 'menu-kcp', par = 'menu start', depth = 0){
    var menuSimanis = Array.from(document.getElementById(id).children);
    var count = 0;
    var ArrayobjMenu = []
    function makeArrayChilder(a){
      if(a.children != undefined){
        a = Array.from(a.children);
        if(a.length > 0){
          return a
        }else{
          return false;
        }
      }else{
        return false;
      }
    };
    (function runChecker(menuSimanis, startfrom = 0, parent = 'menu start'){
      for(var element of menuSimanis){
        if(makeArrayChilder(element) != false){
          var parentNew = parent;
          if(element.getAttribute('validasi-menu') != undefined){
            var newobj = {
              menu: element.getAttribute('validasi-menu'),
              depth: startfrom,
              parent: parent,
              node: element
            }
            parentNew = newobj.menu;
            ArrayobjMenu.push(newobj);
            runChecker(Array.from(element.children), startfrom + 1, parentNew);
          }else{
            runChecker(Array.from(element.children), startfrom + 1, parentNew);
          }
        }else{
          count += 1;
        }
      }
    })(menuSimanis, depth , par);
    return ArrayobjMenu;
  }

  const queryMenus = function(getDataMenus){
    return "INSERT INTO datamenus (menu, parent, depth) \n SELECT menu, parent, depth FROM ( SELECT CONCAT(menu,parent) kode , menu, parent, depth FROM ( \n"+getDataMenus.map(function(a){
      return `
        SELECT '${a.menu}' menu, '${a.parent}' parent, ${a.depth} depth
      `
    }).join(" UNION ALL ")+" \n ) a) a LEFT JOIN (SELECT CONCAT(menu,parent) kode FROM datamenus ) b ON a.kode = b.kode WHERE b.kode IS NULL ";
  }
