var capitalize = (str, lower = false) =>
  (lower ? str.toLowerCase() : str).replace(/(?:^|\s|["'([{])+\S/g, match => match.toUpperCase());
;

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

globalThis.formatRupiah = function(angka, prefix){
    var negative = '';
    if (angka[0] == '-') {
        negative = '-';
    }
    angka = angka.replace(/\./g, ',')
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

const table = function(tableName){
    return {
        data: {
            id: 'id'+Date.now(),
            table: tableName,
            formId: 'form-get-app',
            objform: null,
            primarykey: null,
            multiOrder: [],
            customeH: '',
            idUpdate: 0,
            key: "id",
            formatId: function(format, x){
                var str = "" + x
                var pad = format;
                var ans = pad.substring(0, pad.length - str.length) + str
                return ans;
            },
            title: null,
            disableCreateR: false,
            delay: function(callback, ms) {
              var timer = 0;
              return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                  callback.apply(context, args);
                }, ms || 0);
              };
            },
            condCus: [],
            searchKey: []
        },
        primarykey: function(a){
            this.data.primarykey = a;
            return this;
        },
        searchKey : function(a = []){
          this.data.searchKey = a;
          return this;
        },
        custView: function(){
            this.data.customeView = true;
            return this;
        },
        bataspagin: function(a = 10){
          this.data.bataspagin = bataspagin;
          return this;
        },
        key: function(a){
            this.data.key = a;
            return this;
        },
        condCus: function(a = []){
            this.data.condCus = a;
            return this;
        }
        ,validate: function(a){
            this.data.validate = a;
            return this;
        },
        decodeHtml: function(text) {
            return text
                .replace(/&amp;/g, '&')
                .replace(/&lt;/g , '<')
                .replace(/&gt;/g, '>')
                .replace(/&quot;/g, '"')
                .replace(/&#039;/g,"'");
        },
        back: function(a){
            this.data.back = a;
            return this;
        },
        groupby: function(a = []){
            this.data.groupby = a;
            return this;
        },
        select: function(a){
          this.data.select = a;
          return this;
        },
        wrap: function(a){
          this.data.wrap = a;
          return this;
        },
        order: function(a, b){
          this.data.order = {
            start: a,
            end: b
          };
          return this;
        },
        displayNone: function(a){
            this.data.none = a;
            return this;
        },
        selectAction: function(a){
            this.data.selectAction = a;
            return this;
        }
        ,filter : function(a){
            this.data.filter = a;
            return this;
        },
        afterload: function(func){
            this.data.afterload = func;
            return this;
        },
        onupdate: function(a){
            this.data.onupdate = a;
            return this;
        },
        customeH: function(a){
          this.data.customeH = a;
          return this;
        },
        onsave: function(a){
            this.data.onsave = a;
            return this;
        },
        oncreate: function(a){
            this.data.oncreate = a;
            return this;
        },
        grouping: function(a = {}){
            this.data.group = a;
            return this;
        },
        onback: function(a){
            this.data.backFunc = a;
            return this;
        },
        modal: function(e = ""){
            if (e != "") {
                e = "modal-"+e;
            }
            this.data.modal = e;
            return this;
        },
        title: function(a){
            this.data.title = a;
            return this;
        },
        typeTable: function(a = 'master'){
            this.data.typeTable = a;
            return this;
        },
        row: function(dat){
            this.data.row = dat;
            return this;
        },
        addRow: function(a){
            this.data.addRow = a;
            return this;
        },
        edt: function(e){
            this.data.edt = e;
            return this;
        },
        equals: function(obj){
            this.data.equals = obj;
            return this;
        }
        ,disCreate : function(){
            this.data.disableCreateR = true;
            return this;
        },createForm: function(obj){
            var group = null;
            if (this.data.group != undefined) {
                group = this.data.group;
            }
            this.data.objform = obj;
            var keys = Object.keys(obj);

            this.data.idData = keys;

            var newForm = '';

            var eform = this.data.objform;

            var formP = keys.map(function(elps){

                var groupStart = "";
                var groupEnd = "";

                if (group != null) {
                    var gK = Object.keys(group);
                    for(const gk of gK){
                        for(const gmap of group[gk]){
                            if (gmap.start == elps) {
                                groupStart = `
                                    <div class="${gk}">
                                        <div class="row">
                                `;
                            }
                            if (gmap.end == elps) {
                                groupEnd = `
                                        </div>
                                    </div>
                                `;
                            }
                        }
                    }
                }
                var getObj = obj[elps];
                // cek colom
                if (getObj.typeColumns == undefined) {
                    getObj.typeColumns = "";
                }else{
                    getObj.typeColumns = "-"+getObj.typeColumns;
                }
                if(getObj.columns == undefined){
                    getObj.columns = "-12";
                }else{
                    getObj.columns = "-"+getObj.columns;
                }
                // if input method;
                var label = '<label></label>';
                if (getObj.title != undefined) {
                    label = `
                        <label for="${elps}">${getObj.title}</label>
                    `;
                }

                var vDefault = '';
                if(getObj.default != undefined){
                    vDefault = ` value="${getObj.default}" `;
                }

                var head = '';
                if (getObj.head != undefined) {
                    head = `
                        <div class="col-12 mt-3">
                            <h5 style="font-weight: bold;">${getObj.head}</h5>
                        </div>
                    `;
                }
                if (getObj.form == 'input') {
                    if (getObj.type == 'date') {
                        return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2">
                                    ${label}
                                    <div>
                                      <input type="${getObj.type}" id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" value="${tanggal().normal}" >
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'slug'){
                        return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2">
                                    ${label}
                                    <div>
                                    <input ${vDefault} type="text" readonly="true" style="background: #ddd;" id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" >
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'password'){
                        return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}" style='position:relative;'>
                                <div class="form-group-2 passwd">
                                    ${label}
                                    <div>
                                      <input ${vDefault} type="${getObj.type}" id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" >
                                    </div>
                                    <i id='show-${elps}' class="fas fa-eye-slash eypass" onclick='document.getElementById("${elps}").type = "text";this.style.display="none"; document.getElementById("hide-${elps}").style.display = "inline-block"; ';></i>
                                    <i id='hide-${elps}' class="fas fa-eye eypass" style="display:none;" onclick='document.getElementById("${elps}").type = "password";this.style.display="none"; document.getElementById("show-${elps}").style.display = "inline-block"; '></i>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'number'){
                        return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2">
                                    ${label}
                                    <div>
                                    <input ${vDefault} type="text" id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" >
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'hidden'){
                        return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2" style="display:none;">
                                    ${label}
                                    <div>
                                    <input ${vDefault} type="hidden" id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" >
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'readonly'){
                        return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2">
                                    ${label}
                                    <div>
                                    <input ${vDefault} type="text" style="background: #ddd;" readonly="true" id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" >
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'note'){
                         return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2">
                                    ${label}
                                    <div>
                                    <textarea id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" value="${tanggal().normal}" ></textarea>
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'area'){
                         return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2">
                                    ${label}
                                    <div>
                                    <textarea id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" value="${tanggal().normal}" ></textarea>
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'textarea'){
                         return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2">
                                    ${label}
                                    <div>
                                    <textarea id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" value="${tanggal().normal}" ></textarea>
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'disable'){
                        return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div id="f-${elps}" class="form-group-2">
                                    ${label}
                                    <div>
                                    <input  ${vDefault} type="text" id="${elps}" disabled class="form-control-2" placeholder="${getObj.placeholder}" >
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else if(getObj.type == 'select'){


                        if (getObj.title != undefined) {
                            label = `
                                <label class="label-select" for="${elps}">${getObj.title}</label>
                            `;
                        }

                        var grid = '';
                        for(const inserView of getObj.view){
                            grid += ' auto ';
                        }

                        if (globalThis.listdata == undefined) {
                            globalThis.listdata = {}
                        }
                        globalThis.listdata[elps] = function(fill = null, relation = null){
                            var dataSelect = dataMaster[getObj.table];
                            //console.log(eform[relation])
                            var relationTable = null;
                            var relationValue = null;
                            if(relation != null){
                                var relationTable = eform[relation].table;
                                var relationValue = eform[relation].value;
                                // console.log(relationTable)
                            }
                            if (document.getElementById(relation) != null) {
                                var relatVal = document.getElementById(relation).value;

                                var datasel = dataMaster[relationTable].filter(function(et){
                                    if(et[relationValue] == relatVal){
                                        return et;
                                    }
                                })
                                //console.log(datasel);
                                if(datasel.length > 0){
                                    if(getObj.relationSet != undefined){
                                       relatVal = datasel[0][getObj.relationSet];
                                    }
                                    var par =  eform[relation];
                                    dataSelect = dataSelect.filter(function(es){
                                        if (es[getObj.relationId] == relatVal) {
                                            return es;
                                        }
                                    })
                                }else{
                                    dataSelect = [];
                                }
                            }
                            dataSelect = dataSelect.map(function(rData, v){
                                var valh = rData[getObj.value];
                                var x = 0;
                                var contenthtml = '';
                                var content = {}
                                for(const inserView of getObj.view){
                                    if (fill == null) {
                                        if(x == 0){
                                            var view = '';
                                            content.key = valh;
                                            content.data = rData;
                                            content.title = rData[inserView];
                                            view += rData[inserView];
                                            contenthtml += `<option value="${content.key}">${view}</option>`;
                                        }else{
                                            var view = '';
                                            view += ' '+rData[inserView];
                                            contenthtml += `<option value="${content.key}">${view}</option>`;
                                        }
                                        x++;
                                    }else{
                                        var cek = 0;
                                        var arrc = Object.keys(rData);
                                        for(const cekl of arrc){
                                            if (rData[cekl] != null) {
                                                if (rData[cekl].toLowerCase().indexOf(fill.toLowerCase()) != -1) {
                                                    cek = 1;
                                                }
                                            }
                                        }
                                        if (cek == 1) {
                                            if(x == 0){
                                                var view = '';
                                                content.key = valh;
                                                content.data = rData;
                                                content.title = rData[inserView];
                                                view += rData[inserView];
                                                contenthtml += `<option value="${content.key}">${view}</option>`;
                                            }else{
                                                var view = '';
                                                view += ' '+rData[inserView];
                                                contenthtml += `<option value="${content.key}">${view}</option>`;
                                            }
                                        }
                                        x++;
                                    }
                                }
                                return contenthtml;
                            }).join("")
                            return dataSelect;
                        }

                        return `
                            <style>
                                .select-choice{
                                    display: grid;
                                    grid-template-columns: ${grid};
                                }
                            </style>

                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2">
                                    <input type="search" class="select-search" id="search-choice-${elps}">
                                    <div class="select-choice" id="choice-${elps}">
                                        ${globalThis.listdata[elps]()}
                                    </div>
                                    ${label}
                                    <div>
                                      <select id="${elps}" class="form-control-2" >
                                        <option value="">Pilih Data</option>
                                        ${globalThis.listdata[elps]()}
                                      </select>
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }else{
                        return `
                            ${groupStart}
                            ${head}
                            <div id="f-${elps}" class="col${getObj.typeColumns}${getObj.columns}">
                                <div class="form-group-2">
                                    ${label}
                                    <div>
                                    <input ${vDefault} type="${getObj.type}" id="${elps}" class="form-control-2" placeholder="${getObj.placeholder}" >
                                    </div>
                                </div>
                            </div>
                            ${groupEnd}
                        `;
                    }
                }
            }).join(" ")
            this.data.htmlForm = formP;
            return this;
        }
        ,updateShown: function(dataEncript){
            // console.log('load form')
            var t = this.data.id;
            var htmlForm = this.data.htmlForm;
            var title = this.data.title;
            var cari = "cari-"+t;
            var idN = "tambah-"+t;
            var simpan = "simpan"+t;
            var close = "close"+t;
            var hapus = "hapus"+t;
            var idM = "#modal"+t;
            var idm = "m"+t;
            var update = "[data-update"+t+"]";
            var dataUpdate = "data-update"+t;
            var loadForm = this;
            var pagination = this.data.pagination;
            var totb = this.data.tottb;
            var tbl = this.data.table;
            var startPage = this.data.pagination[this.data.table];
            var totPage = this.data.totData[tbl];
            var bataspagin = this.data.bataspagin;

                    document.getElementById(hapus).style.display = 'inline-block';
                    var tF = 'form-get-app'+t;
                    var getData = dataEncript
                    for(const elpsd of Object.keys(getData)){
                        if (getData[elpsd] == null) {
                            delete getData[elpsd];
                        }
                    }
                    loadForm.data.loadDataEdit = getData;
                    loadForm.data.idUpdate = true;
                    document.getElementById(idm).innerText = 'Ubah '+title;
                    document.querySelector('.form-e').style.display = 'none';
                    document.querySelector('.form-d').style.display = 'block';
                    var htmlForm = loadForm.data.htmlForm
                    document.getElementById(tF).innerHTML = htmlForm;

                    setTimeout(function(){

                        Object.keys(loadForm.data.objform).forEach(function(e){
                            if(loadForm.data.objform[e].type == 'number'){
                                document.getElementById(e).addEventListener('keyup', function(){
                                    var eva = this.value;
                                    eva = eva.replace(/\./g, '');
                                    this.value = formatRupiah(eva);
                                }, false)
                            }

                            if(loadForm.data.objform[e].change != undefined){
                               document.getElementById(e).addEventListener('change', loadForm.data.objform[e].change, false);
                            }

                        })

                        function decodeHtml(text) {
                            return text
                                .replace(/&amp;/g, '&')
                                .replace(/&lt;/g , '<')
                                .replace(/&gt;/g, '>')
                                .replace(/&quot;/g, '"')
                                .replace(/&#039;/g,"'");
                        }

                        loadForm.data.idData.forEach(function(pol){

                            if (getData[pol] != null) {
                                if(loadForm.data.objform[pol].type == "number"){
                                    var numx = Number(getData[pol]).toFixed(0).toString();
                                    document.getElementById(pol).value = formatRupiah(numx);
                                }else if(loadForm.data.objform[pol].type == "select"){
                                    var table = dataMaster[loadForm.data.objform[pol].table];
                                    var val = loadForm.data.objform[pol].value;
                                    var vw = loadForm.data.objform[pol].view;
                                    table = table.filter(function(es){
                                        if (es[val] == getData[pol]) {
                                            return es;
                                        }
                                    })
                                    var tab = null;
                                    var ops = "";
                                    var names = " pilih data ";
                                    if (table.length > 0) {
                                        tab = table[0];
                                        ops = tab[val];
                                        names = vw.map(function(elop){
                                            return tab[elop];
                                        }).join(' ');
                                    }

                                    $("#"+pol).select2();

                                    var formSet = loadForm.data.objform[pol];

                                    if(formSet.pin != undefined){

                                      var stable = loadForm.data.objform[formSet.pin];
                                      var stableRid = stable.relationId;
                                      var stableRval = getData[formSet.pin];

                                      var geTble = dataMaster[stable.table].filter(function(o,i){
                                        if(o[stable.value] == stableRval){
                                          return o;
                                        }
                                      });

                                      if(geTble.length > 0){
                                        geTble = geTble[0];
                                      }

                                      if(stable.key != undefined){
                                        stableRval = geTble[stable.key];
                                      }

                                      // console.log(geTble);
                                      // console.log(formSet.pin);
                                      // console.log(stableRid);
                                      // console.log(stableRval);

                                      var ntable = dataMaster[formSet.table];
                                      var valn = formSet.value;
                                      var viewn = formSet.view;

                                      var optn = ntable
                                      .filter(function(x,i){
                                        if(x[stableRid] == stableRval){
                                          return x;
                                        }
                                      }).map(function(x,i){
                                          var optname = '';
                                          for(var l of viewn){
                                            optname += x[l]+' ';
                                          }
                                          if(x[valn] == ops){
                                            return `
                                            <option selected value="${x[valn]}">${optname}</option>
                                            `;
                                          }else{
                                            return `
                                            <option value="${x[valn]}">${optname}</option>
                                            `;
                                          }
                                      }).join("\n")

                                      document.getElementById(pol).innerHTML = optn;

                                    }else{

                                      var ntable = dataMaster[formSet.table];
                                      var valn = formSet.value;
                                      var viewn = formSet.view;

                                      var optn = ntable.map(function(x,i){
                                        var optname = '';
                                        for(var l of viewn){
                                          optname += x[l]+' ';
                                        }
                                        if(x[valn] == ops){
                                          return `
                                            <option selected value="${x[valn]}">${optname}</option>
                                          `;
                                        }else{
                                          return `
                                            <option value="${x[valn]}">${optname}</option>
                                          `;
                                        }
                                      }).join("\n")

                                      document.getElementById(pol).innerHTML = optn;

                                    }

                                }else if(loadForm.data.objform[pol].type == "note"){
                                    var tp = JSON.parse(decodeHtml(getData[pol]));
                                    tp = binary2text(tp.kontent);
                                    document.getElementById(pol).value = tp;
                                }else{
                                    document.getElementById(pol).value = decodeHtml(getData[pol]);
                                }
                            }
                        })

                        if (loadForm.data.onupdate != undefined) {
                            loadForm.data.onupdate(loadForm, getData, new AuditDev(datalogin));
                        }

                        setTimeout(function(){
                            document.getElementById(loadForm.data.idData[0]).focus();
                        },500)

                        setTimeout(function(){

                            if (loadForm.data.equals != undefined) {
                                for(const eq of loadForm.data.equals){
                                    document.getElementById(eq).addEventListener('keyup', loadForm.data.delay(function(){
                                        var getVals = []
                                        var n = 0;
                                        for(const es of loadForm.data.equals){
                                            var vals = document.getElementById(es).value.replace(/\"/g, "\\\"");
                                            if (n == 0) {
                                                getVals.push({
                                                    opsi: "", data : [es, '=', `"${vals}"`]
                                                })
                                            }else{
                                                getVals.push({
                                                    opsi: "AND", data : [es, '=', `"${vals}"`]
                                                })
                                            }
                                            n++;
                                        }

                                        AuditDev(datalogin)
                                        .table(loadForm.data.table)
                                        .condition(getVals)
                                        .get(function(a, b){
                                            if (Number(b) > 0 ) {
                                                var keysRow = Object.keys(loadForm.data.objform);
                                                var objUpdt = {}
                                                for(const lpp of keysRow){
                                                    if (loadForm.data.objform[lpp].type == "select") {
                                                        document.getElementById(lpp).value = a[0][lpp];
                                                        $('#'+lpp).val(a[0][lpp]).trigger('change');
                                                    }else if(loadForm.data.objform[lpp].type == "number"){
                                                        document.getElementById(lpp).value = formatRupiah(a[0][lpp]);
                                                    }else{
                                                        document.getElementById(lpp).value = a[0][lpp];
                                                    }
                                                    objUpdt[lpp] = a[0][lpp];
                                                }
                                                if (loadForm.data.onupdate != undefined) {
                                                    loadForm.data.onupdate(loadForm, a, new AuditDev(datalogin));
                                                }
                                                document.getElementById(idm).innerText = 'Ubah '+title;
                                                loadForm.data.loadDataEdit = objUpdt;
                                                loadForm.data.idUpdate = true;
                                                document.getElementById(hapus).style.display = 'inline-block';
                                            }else{
                                                document.getElementById(idm).innerText = 'Tambah '+title;
                                                loadForm.data.loadDataEdit = {};
                                                loadForm.data.idUpdate = null;
                                                document.getElementById(hapus).style.display = 'none';
                                                var keysRow = Object.keys(loadForm.data.objform);
                                                for(const lpp of keysRow){
                                                    if (loadForm.data.equals.indexOf(lpp) == -1) {
                                                        document.getElementById(lpp).value = '';
                                                        if (loadForm.data.oncreate != undefined) {
                                                            loadForm.data.oncreate(loadForm, new AuditDev(datalogin));
                                                        }
                                                        if (loadForm.data.objform[lpp].type == "select") {
                                                            $('#'+lpp).val(null).trigger('change');
                                                        }
                                                    }
                                                }
                                            }
                                        })

                                    },500), false)
                                }
                            }
                            document.getElementById(loadForm.data.idData[0]).focus()
                            for(const dataid of loadForm.data.idData){
                                if(loadForm.data.objform[dataid].type == 'note' || loadForm.data.objform[dataid].type == 'textarea'){

                                $('#'+dataid).summernote({
                            			height: 200,
                            			toolbar: [
                            				// [groupName, [list of button]]
                            				['style', ['style']],
                            				['style', ['bold', 'italic', 'underline', 'clear']],
                            				['font', ['strikethrough', 'superscript', 'subscript']],
                            				['fontsize', ['fontsize']],
                            				['color', ['color']],
                            				['insert', [ 'ajaximageupload', 'link', 'video', 'table']],
                            				['para', ['ul', 'ol', 'paragraph']],
                            				['view', ['fullscreen', 'codeview', 'help']],
                            				['height', ['height']]
                            			]
                            		});


                                    var s = Array.from(document.querySelectorAll('.note-editable'))
                                    for (const yi of s) {
                                        yi.addEventListener('focus', function(){

                                            // Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                            //     elm.style.display = 'none';
                                            // })
                                            //
                                            // Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                            //     elm.style.display = 'none';
                                            // })

                                        }, false)
                                    }
                                }

                              if(loadForm.data.objform[dataid].type == 'select'){
                                document.getElementById(dataid).addEventListener('focus', function(){
                                    if (loadForm.data.objform[dataid].relationChange == undefined) {

                                    }else{
                                        var idRelation = loadForm.data.objform[dataid].relationChange;
                                        var dataParent = dataMaster[dataid];
                                        var parenCode = loadForm.data.objform[dataid].value;
                                        var parenView = loadForm.data.objform[dataid].view;
                                        var mainid = loadForm.data.objform[dataid].relationId;
                                        var kodemain = loadForm.data.objform[dataid].value;
                                        var main = loadForm.data.objform[idRelation].table;
                                        var kode = loadForm.data.objform[idRelation].value;
                                        var getVal = document.getElementById(idRelation).value;
                                        var dataMain = dataMaster[main].filter(function(lop){
                                            if (lop[kode] == getVal) {
                                                return lop
                                            }
                                        });
                                        if (dataMain.length > 0) {
                                            var mdata = dataMain[0];
                                            var pId = mdata[mainid];
                                            var getPdata = dataParent.filter(function(e){
                                                if (e[parenCode] == pId) {
                                                    return e
                                                }
                                            })[0];
                                            var vW = parenView.map(function(sa){
                                                return getPdata[sa];
                                            }).join(' ')

                                            document.getElementById(dataid).innerHTML = `<option selected value="${pId}">${vW}</option>`
                                        }
                                        if (loadForm.data.idData.indexOf(document.getElementById(dataid).id) != (loadForm.data.idData.length - 1)) {
                                            var mop = loadForm.data.idData.indexOf(document.getElementById(dataid).id) + 1;
                                            document.getElementById(loadForm.data.idData[mop]).focus();
                                        }else{
                                            document.getElementById(simpan).addEventListener('focus', function(){
                                                Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                                Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                            }, false)
                                            setTimeout(function(){
                                                document.getElementById(simpan).focus();
                                            },100)
                                        }
                                    }
                                }, false)
                            }else{
                                document.getElementById(dataid).addEventListener('focus', function(){

                                }, false)
                            }
                            if (globalThis.actionListUpdate == undefined) {
                                globalThis.actionListUpdate = {}
                            }
                            globalThis.actionListUpdate[dataid] = function(){

                              var e = dataid;

                              $('#'+e).change(()=>{

                                var tbl = loadForm.data.objform[e].table;
                                var key = loadForm.data.objform[e].value;
                                var kz = loadForm.data.objform[e].key;
                                var tbldata = dataMaster[tbl];
                                var vall = $("#"+e).val();

                                tbldata = tbldata.filter((v,i)=>{
                                  if(v[key] == vall){
                                    return v;
                                  }
                                });

                                if(tbldata.length > 0){
                                  tbldata = tbldata[0];
                                }

                                var sp = {
                                  key: vall,
                                  data: tbldata
                                }

                                var obj = loadForm.data.objform[e];

                                if(obj.relation != undefined){

                                  var rL = obj.relation;

                                  var ob2j = loadForm.data.objform[rL];

                                  var gRl = dataMaster[ob2j.table];

                                  if(kz != null){
                                    vall = tbldata[kz];
                                  }

                                  gRl = gRl.filter((w,i)=>{

                                    if(w[obj.relationId] == vall){
                                      return w
                                    }

                                  });

                                  var h = '';
                                  h = gRl.map((x,i)=>{
                                    var v = '';
                                    for(var c of ob2j.view){
                                      v += x[c]+' ';
                                    }

                                    return '<option value="'+x[ob2j.value]+'">'+v+'</option>'

                                  }).join("");

                                  document.getElementById(obj.relation).innerHTML = `<option value="">Pilih Data</option>`+h;

                                }

                                // loadForm.data.selectAction(sp, e,obj)

                                // selectAction(sp, e, obj);

                              })

                                Array.from(document.querySelectorAll('div[data-select-v'+dataid+']')).forEach(function(elm){

                                })
                            }
                            globalThis.actionListUpdate[dataid]()

                                // action form

                                var getredirect = dataid;
                                if (loadForm.data.objform[dataid].type == 'slug') {
                                    document.getElementById(dataid).addEventListener('focus', function(){
                                        var getValFrom = document.getElementById(loadForm.data.objform[dataid].from).value;
                                        this.value = getValFrom.toLowerCase().replace(/ /g,'-')
                                        .replace(/\#/g,'')
                                        .replace(/\'/g,'')
                                        .replace(/\"/g,'')
                                        .replace(/\&/g,'')
                                        .replace(/\^/g,'')
                                        .replace(/\@/g,'')
                                        .replace(/\!/g,'')
                                        .replace(/\~/g,'')
                                        .replace(/\*/g,'')
                                        .replace(/\;/g,'')
                                        .replace(/\:/g,'')
                                        .replace(/\{/g,'')
                                        .replace(/\}/g,'')
                                        .replace(/\,/g,'')
                                        .replace(/\./g,'')
                                        .replace(/\)/g,'')
                                        .replace(/\(/g,'')
                                        .replace(/\%/g,'')
                                        .replace(/\%/g,'')
                                        .replace(/\?/g,'')
                                        .replace(/\//g,'')
                                    }, false)
                                }

                                if (loadForm.data.objform[dataid].type == 'select') {
                                    getredirect = 'search-choice-'+dataid;


                                    document.getElementById('search-choice-'+dataid).addEventListener('keyup', function(){
                                        var relations = null;
                                        if(loadForm.data.objform[dataid].relation != undefined){
                                            relations = loadForm.data.objform[dataid].relation;
                                        }
                                        document.getElementById('choice-'+dataid).innerHTML = globalThis.listdata[dataid](this.value, relations);
                                        globalThis.actionListUpdate[dataid]()
                                    },false)

                                }

                                document.getElementById(getredirect).addEventListener('keypress', function(e){
                                    if (e.key === 'Enter') {
                                        if (loadForm.data.idData.indexOf(document.getElementById(dataid).id) != (loadForm.data.idData.length - 1)) {
                                            var mop = loadForm.data.idData.indexOf(document.getElementById(dataid).id) + 1;
                                            var nextr = loadForm.data.idData[mop];
                                            if(loadForm.data.objform[nextr].type == 'note'){
                                                $('#'+nextr).summernote('focus')
                                                Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                                Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                            }else{
                                                document.getElementById(loadForm.data.idData[mop]).focus();
                                            }
                                        }else{
                                            document.getElementById(simpan).addEventListener('focus', function(){
                                                Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                                Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                            }, false)
                                            setTimeout(function(){
                                                document.getElementById(simpan).focus();
                                            },100)
                                        }
                                      }
                                }, false)
                            }
                        },100)

                    },100)



            setTimeout(function(){

                document.getElementById(simpan).addEventListener('click', function(){

                if (globalThis.coverid != undefined && globalThis.coverid == 0) {
                    alert('Judul dan cover tidak boleh kosong')
                }

                if (globalThis.coverid != undefined && globalThis.coverid == 0) return "Is greater";

                function escapeHtml(text) {
                    return text
                        .replace(/&/g, "&amp;")
                        .replace(/</g, "&lt;")
                        .replace(/>/g, "&gt;")
                        .replace(/"/g, "&quot;")
                        .replace(/'/g, "&#039;");
                }

                var dataA = {}

                loadForm.data.idData.map(function(pol){
                    if (loadForm.data.objform[pol].type == 'number') {
                        var num = document.getElementById(pol).value.replace(/\./g, '').replace(/\,/g, '.');
                        num = Number(num).toFixed(0).toString();
                        dataA[pol] = num;
                    }else if(loadForm.data.objform[pol].type == 'date'){
                        var evf = escapeHtml(document.getElementById(pol).value.replace(/\"/g, '\\\"'));
                        if (evf == '') {
                            evf = "null";
                        }
                        dataA[pol] = evf;
                    }else if(loadForm.data.objform[pol].type == 'note'){
                        dataA[pol] = escapeHtml(JSON.stringify({
                                kontent: text2Binary(document.getElementById(pol).value)}
                            ));
                    }else{
                        dataA[pol] = escapeHtml(document.getElementById(pol).value.replace(/\"/g, '\\\"'));
                    }
                })

                var validEr = null;
                if(loadForm.data.validate != undefined){
                    var validate = loadForm.data.validate;
                    Object.keys(loadForm.data.validate).forEach(function(key){

                        if(dataA[key] == validate[key]){
                            if(validEr == null){
                                validEr = key
                            }
                        }

                    })
                    if(validEr != null){
                        document.getElementById(validEr).focus();
                        document.getElementById(validEr).scrollIntoView();
                        alert(capitalize(validEr) + ' tidak boleh kosong')
                        return false;
                    }
                }

                if(validEr == null){

                    var sopd = AuditDev(datalogin).table(loadForm.data.table)
                    //console.log(loadForm.data.idUpdate);
                    if(loadForm.data.idUpdate != null){
                        var epso = [];
                        if (loadForm.data.equals != undefined) {
                            var dataList = {};
                            loadForm.data.equals.forEach(function(a){
                                dataList[a] = dataA[a];
                            })
                            loadForm.data.loadDataEdit = dataList;
                        }
                        if (loadForm.data.edt != undefined) {
                            var dataList = {};
                            loadForm.data.edt.forEach(function(a){
                                dataList[a] = dataA[a];
                            })
                            loadForm.data.loadDataEdit = dataList;
                        }
                        Object.keys(loadForm.data.loadDataEdit).forEach(function(elps, i){
                            var lop = loadForm.data.loadDataEdit[elps].toString().replace(/\"/g, '\\\"');
                            if (lop == "null") {
                                lop = null
                            }else{
                                lop = `"${lop}"`;
                            }
                            if (lop != null) {
                                if (i == 0) {
                                    epso.push({opsi:"", data: [elps, '=',`${lop}`]});
                                }else{
                                    epso.push({opsi:"AND", data: [elps, '=',`${lop}`]});
                                }
                            }
                        })
                        //console.log(epso);
                        sopd.condition(epso);
                        sopd.update(dataA);
                    }else{

                       if (loadForm.data.primarykey != undefined) {
                           delete dataA[loadForm.data.primarykey];
                       }



                        sopd.save(dataA)

                    }
                    sopd.get(function(res){
                        if (res == 'disimpan') {
                            if(loadForm.data.idUpdate != null){
                                swal(
                                    'Success!',
                                    'Data berhasil di ubah!',
                                    'success'
                                )
                            }else{
                                swal(
                                    'Success!',
                                    'Data berhasil di tambahkan!',
                                    'success'
                                )
                            }
                            // document.querySelector('.form-e').style.display = 'block';
                            // document.querySelector('.form-d').style.display = 'none';
                            setTimeout(function(){
                                // setting for custome proses save
                                if(loadForm.data.onsave != undefined){
                                    loadForm.data.onsave(loadForm, dataA)
                                }else{
                                    loadForm.load();
                                }
                            },100)
                        }
                    })
                }
            },false)

            })

        }
        ,newData: function(){
            // console.log('load form')
            var t = this.data.id;
            var htmlForm = this.data.htmlForm;
            var title = this.data.title;
            var cari = "cari-"+t;
            var idN = "tambah-"+t;
            var simpan = "simpan"+t;
            var close = "close"+t;
            var hapus = "hapus"+t;
            var idM = "#modal"+t;
            var idm = "m"+t;
            var update = "[data-update"+t+"]";
            var dataUpdate = "data-update"+t;
            var loadForm = this;
            var pagination = this.data.pagination;
            var totb = this.data.tottb;
            var tbl = this.data.table;
            var startPage = this.data.pagination[this.data.table];
            var totPage = this.data.totData[tbl];
            var bataspagin = this.data.bataspagin;

            if (document.getElementById(cari) != undefined) {
                document.getElementById(cari).addEventListener('keypress', function(e){
                    if (e.key === 'Enter') {
                        loadForm.data.pagination[loadForm.data.table] = 0;
                        loadForm.data.search = this.value;
                        loadForm.load();
                    }
                }, false)
            }
            if(document.getElementById(close) != undefined){
              document.getElementById(close).addEventListener('click', function(){

                if (loadForm.data.backFunc != undefined) {

                  document.getElementById('load-'+tableName).innerHTML = `
                  <div class="row">
                  <div class="col-12 text-center">
                  <br>
                  <br>
                  <br>
                  <br>
                  <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                  </div>
                  <p>please wait...</>
                  </div>
                  </div>
                  `;

                  loadForm.data.backFunc(loadForm);
                }else{
                  loadForm.load();
                }

              },false)
            }

            if(document.getElementById("prev-"+t) != undefined){
              document.getElementById("prev-"+t).addEventListener('click', function(){
                if ((Number(startPage) - bataspagin) < 0) {
                  swal('anda berada di halaman awal', '', 'info')
                }else{
                  pagination[loadForm.data.table] = startPage - bataspagin;
                  loadForm.load();
                }
              },false)
            }
            if(document.getElementById("next-"+t) != undefined){
              document.getElementById("next-"+t).addEventListener('click', function(){
                if ((Number(startPage) + bataspagin) >= Number(totPage)) {
                  swal('anda berada di halaman akhir', '', 'info')
                }else{
                  pagination[loadForm.data.table] = startPage + bataspagin;
                  loadForm.load();
                }
              },false)
            }
            if(document.getElementById("goval-"+t) !== undefined){
              document.getElementById("goval-"+t).addEventListener('keyup', function(event){
                var val = Number(event.target.value);
                var gh = totb;
                // console.log(val)
                // console.log(gh)
                if(val > gh){
                  event.target.value = gh
                }
              },false)
            }
            if(document.getElementById("go-"+t) != undefined){
              document.getElementById("go-"+t).addEventListener('click', function(event){
                var val = Number(document.getElementById('goval-'+t).value) - 1;
                pagination[loadForm.data.table] = val * bataspagin;
                loadForm.load();
              },false)
            }

            Array.from(document.querySelectorAll(update)).forEach(function(elupdate, i){

                elupdate.addEventListener('click', function(){
                    document.getElementById(hapus).style.display = 'inline-block';
                    var tF = 'form-get-app'+t;
                    var getData = binary2text(this.getAttribute(dataUpdate));
                    for(const elpsd of Object.keys(getData)){
                        if (getData[elpsd] == null) {
                            delete getData[elpsd];
                        }
                    }
                    loadForm.data.loadDataEdit = getData;
                    loadForm.data.idUpdate = true;
                    document.getElementById(idm).innerText = 'Ubah '+title;
                    document.querySelector('.form-e').style.display = 'none';
                    document.querySelector('.form-d').style.display = 'block';
                    var htmlForm = loadForm.data.htmlForm
                    document.getElementById(tF).innerHTML = htmlForm;

                    setTimeout(function(){

                        Object.keys(loadForm.data.objform).forEach(function(e){
                            if(loadForm.data.objform[e].type == 'number'){
                                document.getElementById(e).addEventListener('keyup', function(){
                                    var eva = this.value;
                                    eva = eva.replace(/\./g, '');
                                    this.value = formatRupiah(eva);
                                }, false)
                            }

                            if(loadForm.data.objform[e].change != undefined){
                               document.getElementById(e).addEventListener('change', loadForm.data.objform[e].change, false);
                            }

                        })

                        function decodeHtml(text) {
                            return text
                                .replace(/&amp;/g, '&')
                                .replace(/&lt;/g , '<')
                                .replace(/&gt;/g, '>')
                                .replace(/&quot;/g, '"')
                                .replace(/&#039;/g,"'");
                        }

                        loadForm.data.idData.forEach(function(pol){

                            if (getData[pol] != null) {
                                if(loadForm.data.objform[pol].type == "number"){
                                    var numx = Number(getData[pol]).toFixed(0).toString();
                                    document.getElementById(pol).value = formatRupiah(numx);
                                }else if(loadForm.data.objform[pol].type == "select"){
                                    var table = dataMaster[loadForm.data.objform[pol].table];
                                    var val = loadForm.data.objform[pol].value;
                                    var vw = loadForm.data.objform[pol].view;
                                    table = table.filter(function(es){
                                        if (es[val] == getData[pol]) {
                                            return es;
                                        }
                                    })
                                    var tab = null;
                                    var ops = "";
                                    var names = " pilih data ";
                                    if (table.length > 0) {
                                        tab = table[0];
                                        ops = tab[val];
                                        names = vw.map(function(elop){
                                            return tab[elop];
                                        }).join(' ');
                                    }

                                    $("#"+pol).select2();

                                    var formSet = loadForm.data.objform[pol];

                                    if(formSet.pin != undefined){

                                      var stable = loadForm.data.objform[formSet.pin];
                                      var stableRid = stable.relationId;
                                      var stableRval = getData[formSet.pin];

                                      var geTble = dataMaster[stable.table].filter(function(o,i){
                                        if(o[stable.value] == stableRval){
                                          return o;
                                        }
                                      });

                                      if(geTble.length > 0){
                                        geTble = geTble[0];
                                      }

                                      if(stable.key != undefined){
                                        stableRval = geTble[stable.key];
                                      }

                                      // console.log(geTble);
                                      // console.log(formSet.pin);
                                      // console.log(stableRid);
                                      // console.log(stableRval);

                                      var ntable = dataMaster[formSet.table];
                                      var valn = formSet.value;
                                      var viewn = formSet.view;

                                      var optn = ntable
                                      .filter(function(x,i){
                                        if(x[stableRid] == stableRval){
                                          return x;
                                        }
                                      }).map(function(x,i){
                                          var optname = '';
                                          for(var l of viewn){
                                            optname += x[l]+' ';
                                          }
                                          if(x[valn] == ops){
                                            return `
                                            <option selected value="${x[valn]}">${optname}</option>
                                            `;
                                          }else{
                                            return `
                                            <option value="${x[valn]}">${optname}</option>
                                            `;
                                          }
                                      }).join("\n")

                                      document.getElementById(pol).innerHTML = `<option value="">Pilih Data</option>`+optn;

                                    }else{

                                      var ntable = dataMaster[formSet.table];
                                      var valn = formSet.value;
                                      var viewn = formSet.view;

                                      var optn = ntable.map(function(x,i){
                                        var optname = '';
                                        for(var l of viewn){
                                          optname += x[l]+' ';
                                        }
                                        if(x[valn] == ops){
                                          return `
                                            <option selected value="${x[valn]}">${optname}</option>
                                          `;
                                        }else{
                                          return `
                                            <option value="${x[valn]}">${optname}</option>
                                          `;
                                        }
                                      }).join("\n")

                                      document.getElementById(pol).innerHTML = `<option value="">Pilih Data</option>`+optn;

                                    }

                                }else if(loadForm.data.objform[pol].type == "note"){
                                    var tp = JSON.parse(decodeHtml(getData[pol]));
                                    tp = binary2text(tp.kontent);
                                    document.getElementById(pol).value = tp;
                                }else{
                                    document.getElementById(pol).value = decodeHtml(getData[pol]);
                                }
                            }
                        })

                        if (loadForm.data.onupdate != undefined) {
                            loadForm.data.onupdate(loadForm, getData, new AuditDev(datalogin));
                        }

                        setTimeout(function(){
                            document.getElementById(loadForm.data.idData[0]).focus();
                        },500)

                        setTimeout(function(){

                            if (loadForm.data.equals != undefined) {
                                for(const eq of loadForm.data.equals){
                                    document.getElementById(eq).addEventListener('keyup', loadForm.data.delay(function(){
                                        var getVals = []
                                        var n = 0;
                                        for(const es of loadForm.data.equals){
                                            var vals = document.getElementById(es).value.replace(/\"/g, "\\\"");
                                            if (n == 0) {
                                                getVals.push({
                                                    opsi: "", data : [es, '=', `"${vals}"`]
                                                })
                                            }else{
                                                getVals.push({
                                                    opsi: "AND", data : [es, '=', `"${vals}"`]
                                                })
                                            }
                                            n++;
                                        }

                                        AuditDev(datalogin)
                                        .table(loadForm.data.table)
                                        .condition(getVals)
                                        .get(function(a, b){
                                            if (Number(b) > 0 ) {
                                                var keysRow = Object.keys(loadForm.data.objform);
                                                var objUpdt = {}
                                                for(const lpp of keysRow){
                                                    if (loadForm.data.objform[lpp].type == "select") {
                                                        document.getElementById(lpp).value = a[0][lpp];
                                                        $('#'+lpp).val(a[0][lpp]).trigger('change');
                                                    }else if(loadForm.data.objform[lpp].type == "number"){
                                                        document.getElementById(lpp).value = formatRupiah(a[0][lpp]);
                                                    }else{
                                                        document.getElementById(lpp).value = a[0][lpp];
                                                    }
                                                    objUpdt[lpp] = a[0][lpp];
                                                }
                                                if (loadForm.data.onupdate != undefined) {
                                                    loadForm.data.onupdate(loadForm, a, new AuditDev(datalogin));
                                                }
                                                document.getElementById(idm).innerText = 'Ubah '+title;
                                                loadForm.data.loadDataEdit = objUpdt;
                                                loadForm.data.idUpdate = true;
                                                document.getElementById(hapus).style.display = 'inline-block';
                                            }else{
                                                document.getElementById(idm).innerText = 'Tambah '+title;
                                                loadForm.data.loadDataEdit = {};
                                                loadForm.data.idUpdate = null;
                                                document.getElementById(hapus).style.display = 'none';
                                                var keysRow = Object.keys(loadForm.data.objform);
                                                for(const lpp of keysRow){
                                                    if (loadForm.data.equals.indexOf(lpp) == -1) {
                                                        document.getElementById(lpp).value = '';
                                                        if (loadForm.data.oncreate != undefined) {
                                                            loadForm.data.oncreate(loadForm, new AuditDev(datalogin));
                                                        }
                                                        if (loadForm.data.objform[lpp].type == "select") {
                                                            $('#'+lpp).val(null).trigger('change');
                                                        }
                                                    }
                                                }
                                            }
                                        })

                                    },500), false)
                                }
                            }
                            document.getElementById(loadForm.data.idData[0]).focus()
                            for(const dataid of loadForm.data.idData){
                                if(loadForm.data.objform[dataid].type == 'note' || loadForm.data.objform[dataid].type == 'textarea'){

                                $('#'+dataid).summernote({
                            			height: 200,
                            			toolbar: [
                            				// [groupName, [list of button]]
                            				['style', ['style']],
                            				['style', ['bold', 'italic', 'underline', 'clear']],
                            				['font', ['strikethrough', 'superscript', 'subscript']],
                            				['fontsize', ['fontsize']],
                            				['color', ['color']],
                            				['insert', [ 'ajaximageupload', 'link', 'video', 'table']],
                            				['para', ['ul', 'ol', 'paragraph']],
                            				['view', ['fullscreen', 'codeview', 'help']],
                            				['height', ['height']]
                            			]
                            		});

                                // globalThis['form-'+dataid] = ClassicEditor
                                // .create(document.querySelector('#'+dataid))
                                // .then(editor => {
                                //     globalThis['form-'+dataid] = editor;
                                // })
                                // .catch(error => {
                                //     console.error(error);
                                // });


                                    var s = Array.from(document.querySelectorAll('.note-editable'))
                                    for (const yi of s) {
                                        yi.addEventListener('focus', function(){

                                            // Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                            //     elm.style.display = 'none';
                                            // })
                                            //
                                            // Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                            //     elm.style.display = 'none';
                                            // })

                                        }, false)
                                    }
                                }

                              if(loadForm.data.objform[dataid].type == 'select'){
                                document.getElementById(dataid).addEventListener('focus', function(){
                                    if (loadForm.data.objform[dataid].relationChange == undefined) {

                                    }else{
                                        var idRelation = loadForm.data.objform[dataid].relationChange;
                                        var dataParent = dataMaster[dataid];
                                        var parenCode = loadForm.data.objform[dataid].value;
                                        var parenView = loadForm.data.objform[dataid].view;
                                        var mainid = loadForm.data.objform[dataid].relationId;
                                        var kodemain = loadForm.data.objform[dataid].value;
                                        var main = loadForm.data.objform[idRelation].table;
                                        var kode = loadForm.data.objform[idRelation].value;
                                        var getVal = document.getElementById(idRelation).value;
                                        var dataMain = dataMaster[main].filter(function(lop){
                                            if (lop[kode] == getVal) {
                                                return lop
                                            }
                                        });
                                        if (dataMain.length > 0) {
                                            var mdata = dataMain[0];
                                            var pId = mdata[mainid];
                                            var getPdata = dataParent.filter(function(e){
                                                if (e[parenCode] == pId) {
                                                    return e
                                                }
                                            })[0];
                                            var vW = parenView.map(function(sa){
                                                return getPdata[sa];
                                            }).join(' ')

                                            document.getElementById(dataid).innerHTML = `<option selected value="${pId}">${vW}</option>`
                                        }
                                        if (loadForm.data.idData.indexOf(document.getElementById(dataid).id) != (loadForm.data.idData.length - 1)) {
                                            var mop = loadForm.data.idData.indexOf(document.getElementById(dataid).id) + 1;
                                            document.getElementById(loadForm.data.idData[mop]).focus();
                                        }else{
                                            document.getElementById(simpan).addEventListener('focus', function(){
                                                Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                                Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                            }, false)
                                            setTimeout(function(){
                                                document.getElementById(simpan).focus();
                                            },100)
                                        }
                                    }
                                }, false)
                            }else{
                                document.getElementById(dataid).addEventListener('focus', function(){

                                }, false)
                            }
                            if (globalThis.actionListUpdate == undefined) {
                                globalThis.actionListUpdate = {}
                            }
                            globalThis.actionListUpdate[dataid] = function(){

                              var e = dataid;

                              $('#'+e).change(()=>{

                                var tbl = loadForm.data.objform[e].table;
                                var key = loadForm.data.objform[e].value;
                                var kz = loadForm.data.objform[e].key;
                                var tbldata = dataMaster[tbl];
                                var vall = $("#"+e).val();

                                tbldata = tbldata.filter((v,i)=>{
                                  if(v[key] == vall){
                                    return v;
                                  }
                                });

                                if(tbldata.length > 0){
                                  tbldata = tbldata[0];
                                }

                                var sp = {
                                  key: vall,
                                  data: tbldata
                                }

                                var obj = loadForm.data.objform[e];

                                if(obj.relation != undefined){

                                  var rL = obj.relation;

                                  var ob2j = loadForm.data.objform[rL];

                                  var gRl = dataMaster[ob2j.table];

                                  if(kz != null){
                                    vall = tbldata[kz];
                                  }

                                  gRl = gRl.filter((w,i)=>{

                                    if(w[obj.relationId] == vall){
                                      return w
                                    }

                                  });

                                  var h = '';
                                  h = gRl.map((x,i)=>{
                                    var v = '';
                                    for(var c of ob2j.view){
                                      v += x[c]+' ';
                                    }

                                    return '<option value="'+x[ob2j.value]+'">'+v+'</option>'

                                  }).join("");

                                  document.getElementById(obj.relation).innerHTML = `<option value="">Pilih Data</option>`+h;

                                }

                                // loadForm.data.selectAction(sp, e,obj)

                                // selectAction(sp, e, obj);

                              })

                                Array.from(document.querySelectorAll('div[data-select-v'+dataid+']')).forEach(function(elm){

                                })
                            }
                            globalThis.actionListUpdate[dataid]()

                                // action form

                                var getredirect = dataid;
                                if (loadForm.data.objform[dataid].type == 'slug') {
                                    document.getElementById(dataid).addEventListener('focus', function(){
                                        var getValFrom = document.getElementById(loadForm.data.objform[dataid].from).value;
                                        this.value = getValFrom.toLowerCase().replace(/ /g,'-')
                                        .replace(/\#/g,'')
                                        .replace(/\'/g,'')
                                        .replace(/\"/g,'')
                                        .replace(/\&/g,'')
                                        .replace(/\^/g,'')
                                        .replace(/\@/g,'')
                                        .replace(/\!/g,'')
                                        .replace(/\~/g,'')
                                        .replace(/\*/g,'')
                                        .replace(/\;/g,'')
                                        .replace(/\:/g,'')
                                        .replace(/\{/g,'')
                                        .replace(/\}/g,'')
                                        .replace(/\,/g,'')
                                        .replace(/\./g,'')
                                        .replace(/\)/g,'')
                                        .replace(/\(/g,'')
                                        .replace(/\%/g,'')
                                        .replace(/\%/g,'')
                                        .replace(/\?/g,'')
                                        .replace(/\//g,'')
                                    }, false)
                                }

                                if (loadForm.data.objform[dataid].type == 'select') {
                                    getredirect = 'search-choice-'+dataid;


                                    document.getElementById('search-choice-'+dataid).addEventListener('keyup', function(){
                                        var relations = null;
                                        if(loadForm.data.objform[dataid].relation != undefined){
                                            relations = loadForm.data.objform[dataid].relation;
                                        }
                                        document.getElementById('choice-'+dataid).innerHTML = globalThis.listdata[dataid](this.value, relations);
                                        globalThis.actionListUpdate[dataid]()
                                    },false)

                                }

                                document.getElementById(getredirect).addEventListener('keypress', function(e){
                                    if (e.key === 'Enter') {
                                        if (loadForm.data.idData.indexOf(document.getElementById(dataid).id) != (loadForm.data.idData.length - 1)) {
                                            var mop = loadForm.data.idData.indexOf(document.getElementById(dataid).id) + 1;
                                            var nextr = loadForm.data.idData[mop];
                                            if(loadForm.data.objform[nextr].type == 'note'){
                                                $('#'+nextr).summernote('focus')
                                                Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                                Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                            }else{
                                                document.getElementById(loadForm.data.idData[mop]).focus();
                                            }
                                        }else{
                                            document.getElementById(simpan).addEventListener('focus', function(){
                                                Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                                Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                                    elm.style.display = 'none';
                                                })
                                            }, false)
                                            setTimeout(function(){
                                                document.getElementById(simpan).focus();
                                            },100)
                                        }
                                      }
                                }, false)
                            }
                        },100)

                    },100)
                },false)
            })

            document.getElementById(hapus).addEventListener('click',function(){
                swal({
                    title: 'Apa anda yakin untuk menghapus data ini?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `hapus`,
                    denyButtonText: `batalkan`,
                  }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        var sopd = AuditDev(datalogin).table(loadForm.data.table)
                        var epso = [];

                        var edt = loadForm.data.loadDataEdit;

                        if (loadForm.data.equals != undefined) {
                            var dataList = {};
                            loadForm.data.equals.forEach(function(a){
                                dataList[a] = loadForm.data.loadDataEdit[a];
                            })
                            edt = dataList;
                        }

                        Object.keys(edt).forEach(function(elps, i){
                            var lop = edt[elps];
                            if (lop == "null") {
                                lop = null
                            }else{
                                lop = `"${lop.replace(/\"/g, "\\\"")}"`;
                            }
                            if (lop != null) {
                                if (i == 0) {
                                    epso.push({opsi:"", data: [elps, '=',`${lop}`]});
                                }else{
                                    epso.push({opsi:"AND", data: [elps, '=',`${lop}`]});
                                }
                            }
                        })

                        sopd.condition(epso);
                        sopd.delete();
                        sopd.get(function(res){
                            if(loadForm.data.onsave != undefined){
                              loadForm.data.onsave(loadForm, loadForm.data.loadDataEdit, 1)
                            }else{
                              loadForm.load();
                            }
                            if (res == 'disimpan') {
                                swal(
                                    'Success!',
                                    'Data berhasil di hapus!',
                                    'success'
                                )
                            }
                        })

                    } else if (result.isDenied) {
                      swal('Perintah dibatalkan', '', 'info')
                    }
                  })

            },false)

            document.getElementById(simpan).addEventListener('click', function(){

                if (globalThis.coverid != undefined && globalThis.coverid == 0) {
                    alert('Judul dan cover tidak boleh kosong')
                }

                if (globalThis.coverid != undefined && globalThis.coverid == 0) return "Is greater";

                function escapeHtml(text) {
                    return text
                        .replace(/&/g, "&amp;")
                        .replace(/</g, "&lt;")
                        .replace(/>/g, "&gt;")
                        .replace(/"/g, "&quot;")
                        .replace(/'/g, "&#039;");
                }

                var dataA = {}

                loadForm.data.idData.map(function(pol){
                    if (loadForm.data.objform[pol].type == 'number') {
                        var num = document.getElementById(pol).value.replace(/\./g, '').replace(/\,/g, '.');
                        num = Number(num).toFixed(0).toString();
                        dataA[pol] = num;
                    }else if(loadForm.data.objform[pol].type == 'date'){
                        var evf = escapeHtml(document.getElementById(pol).value.replace(/\"/g, '\\\"'));
                        if (evf == '') {
                            evf = "null";
                        }
                        dataA[pol] = evf;
                    }else if(loadForm.data.objform[pol].type == 'note'){
                        dataA[pol] = escapeHtml(JSON.stringify({
                                kontent: text2Binary(document.getElementById(pol).value)}
                            ));
                    }else{
                        dataA[pol] = escapeHtml(document.getElementById(pol).value.replace(/\"/g, '\\\"'));
                    }
                })

                var validEr = null;
                if(loadForm.data.validate != undefined){
                    var validate = loadForm.data.validate;
                    Object.keys(loadForm.data.validate).forEach(function(key){

                        if(dataA[key] == validate[key]){
                            if(validEr == null){
                                validEr = key
                            }
                        }

                    })
                    if(validEr != null){
                        document.getElementById(validEr).focus();
                        document.getElementById(validEr).scrollIntoView();
                        alert(capitalize(validEr) + ' tidak boleh kosong')
                        return false;
                    }
                }

                if(validEr == null){
                    document.getElementById('load-'+tableName).innerHTML = `
                    <div class="row">
                        <div class="col-12 text-center">
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="spinner-border" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                            <p>please wait...</>
                        </div>
                    </div>
                    `;
                    var sopd = AuditDev(datalogin).table(loadForm.data.table)
                    //console.log(loadForm.data.idUpdate);
                    if(loadForm.data.idUpdate != null){
                        var epso = [];
                        if (loadForm.data.equals != undefined) {
                            var dataList = {};
                            loadForm.data.equals.forEach(function(a){
                                dataList[a] = dataA[a];
                            })
                            loadForm.data.loadDataEdit = dataList;
                        }
                        if (loadForm.data.edt != undefined) {
                            var dataList = {};
                            loadForm.data.edt.forEach(function(a){
                                dataList[a] = dataA[a];
                            })
                            loadForm.data.loadDataEdit = dataList;
                        }
                        Object.keys(loadForm.data.loadDataEdit).forEach(function(elps, i){
                            var lop = loadForm.data.loadDataEdit[elps].toString().replace(/\"/g, '\\\"');
                            if (lop == "null") {
                                lop = null
                            }else{
                                lop = `"${lop}"`;
                            }
                            if (lop != null) {
                                if (i == 0) {
                                    epso.push({opsi:"", data: [elps, '=',`${lop}`]});
                                }else{
                                    epso.push({opsi:"AND", data: [elps, '=',`${lop}`]});
                                }
                            }
                        })
                        //console.log(epso);
                        sopd.condition(epso);
                        sopd.update(dataA);
                    }else{

                       if (loadForm.data.primarykey != undefined) {
                           delete dataA[loadForm.data.primarykey];
                       }



                        sopd.save(dataA)

                    }
                    sopd.get(function(res){
                        if (res == 'disimpan') {
                            if(loadForm.data.idUpdate != null){
                                swal(
                                    'Success!',
                                    'Data berhasil di ubah!',
                                    'success'
                                )
                            }else{
                                swal(
                                    'Success!',
                                    'Data berhasil di tambahkan!',
                                    'success'
                                )
                            }
                            // document.querySelector('.form-e').style.display = 'block';
                            // document.querySelector('.form-d').style.display = 'none';
                            setTimeout(function(){
                                // setting for custome proses save
                                if(loadForm.data.onsave != undefined){
                                    loadForm.data.onsave(loadForm, dataA)
                                }else{
                                    loadForm.load();
                                }
                            },100)
                        }
                    })
                }
            },false)

            if(document.getElementById(idN) != undefined){
              document.getElementById(idN).addEventListener('click',function(){
                var tF = 'form-get-app'+t;
                document.querySelector('.form-e').style.display = 'none';
                document.querySelector('.form-d').style.display = 'block';
                loadForm.data.idUpdate = null;
                document.getElementById(hapus).style.display = 'none';
                setTimeout(function(){
                  document.getElementById(idm).innerText = 'Tambah '+title;
                  var htmlForm = loadForm.data.htmlForm
                  document.getElementById(tF).innerHTML = htmlForm;
                  if (loadForm.data.oncreate != undefined) {
                    loadForm.data.oncreate(loadForm, new AuditDev(datalogin));
                  }
                  setTimeout(function(){
                    document.getElementById(loadForm.data.idData[0]).focus();
                  },500)
                  setTimeout(function(){

                    Object.keys(loadForm.data.objform).forEach(function(e){
                      if(loadForm.data.objform[e].type == 'note'){
                        $('#'+e).summernote({
                          height: 200,
                          toolbar: [
                            // [groupName, [list of button]]
                            ['style', ['style']],
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['insert', [ 'ajaximageupload', 'link', 'video', 'table']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['view', ['fullscreen', 'codeview', 'help']],
                            ['height', ['height']]
                          ]
                        });

                        var s = Array.from(document.querySelectorAll('.note-editable'))
                        for (const yi of s) {
                          yi.addEventListener('focus', function(){



                          }, false)
                        }

                      }
                      if(loadForm.data.objform[e].type == 'number'){
                        document.getElementById(e).addEventListener('keyup', function(){
                          var eva = this.value;
                          eva = eva.replace(/\./g, '');
                          this.value = formatRupiah(eva);
                        }, false)
                      }
                      if(loadForm.data.objform[e].type == 'select'){

                        $('#'+e).select2();

                        document.getElementById(e).addEventListener('focus', function(){

                          if (loadForm.data.objform[e].relationChange == undefined) {

                          }else{
                            var idRelation = loadForm.data.objform[e].relationChange;
                            var dataParent = dataMaster[e];
                            var parenCode = loadForm.data.objform[e].value;
                            var parenView = loadForm.data.objform[e].view;
                            var mainid = loadForm.data.objform[e].relationId;
                            var kodemain = loadForm.data.objform[e].value;
                            var main = loadForm.data.objform[idRelation].table;
                            var kode = loadForm.data.objform[idRelation].value;
                            var getVal = document.getElementById(idRelation).value;
                            var dataMain = dataMaster[main].filter(function(lop){
                              if (lop[kode] == getVal) {
                                return lop
                              }
                            });
                            if (dataMain.length > 0) {
                              var mdata = dataMain[0];
                              var pId = mdata[mainid];
                              var getPdata = dataParent.filter(function(e){
                                if (e[parenCode] == pId) {
                                  return e
                                }
                              })[0];
                              var vW = parenView.map(function(sa){
                                return getPdata[sa];
                              }).join(' ')
                              document.getElementById(e).innerHTML = `<option selected value="${pId}">${vW}</option>`
                            }

                            if (loadForm.data.idData.indexOf(document.getElementById(e).id) != (loadForm.data.idData.length - 1)) {
                              var mop = loadForm.data.idData.indexOf(document.getElementById(e).id) + 1;
                              document.getElementById(loadForm.data.idData[mop]).focus();
                            }else{
                              document.getElementById(simpan).addEventListener('focus', function(){

                              }, false)
                              setTimeout(function(){
                                document.getElementById(simpan).focus();
                              },100)
                            }
                          }
                        }, false)
                      }else{
                        document.getElementById(e).addEventListener('focus', function(){

                        }, false)
                      }
                      if (globalThis.actionListNew == undefined) {
                        globalThis.actionListNew = {}
                      }
                      globalThis.actionListNew[e] = function(){

                        // new select2

                        $('#'+e).change(()=>{

                          var tbl = loadForm.data.objform[e].table;
                          var key = loadForm.data.objform[e].value;
                          var kz = loadForm.data.objform[e].key;
                          var tbldata = dataMaster[tbl];
                          var vall = $("#"+e).val();

                          tbldata = tbldata.filter((v,i)=>{
                            if(v[key] == vall){
                              return v;
                            }
                          });

                          if(tbldata.length > 0){
                            tbldata = tbldata[0];
                          }

                          var sp = {
                            key: vall,
                            data: tbldata
                          }

                          var obj = loadForm.data.objform[e];

                          if(obj.relation != undefined){

                            var rL = obj.relation;

                            var ob2j = loadForm.data.objform[rL];

                            var gRl = dataMaster[ob2j.table];

                            if(kz != null){
                              vall = tbldata[kz];
                            }

                            gRl = gRl.filter((w,i)=>{

                              if(w[obj.relationId] == vall){
                                return w
                              }

                            });

                            var h = '';
                            h = gRl.map((x,i)=>{
                              var v = '';
                              for(var c of ob2j.view){
                                v += x[c]+' ';
                              }

                              return '<option value="'+x[ob2j.value]+'">'+v+'</option>'

                            }).join("");

                            document.getElementById(obj.relation).innerHTML = `<option value="">Pilih Data</option>`+h;

                          }

                          // loadForm.data.selectAction(sp, e,obj)

                          // selectAction(sp, e, obj);

                        })

                        Array.from(document.querySelectorAll('div[data-select-v'+e+']')).forEach(function(elm){

                        })
                      }
                      globalThis.actionListNew[e]();

                    })



                    if (loadForm.data.equals != undefined) {
                      for(const eq of loadForm.data.equals){

                        document.getElementById(eq).addEventListener('keyup', loadForm.data.delay(function(){
                          var getVals = []
                          var n = 0;
                          for(const es of loadForm.data.equals){
                            var vals = document.getElementById(es).value.replace(/\"/g, "\\\"");
                            if (n == 0) {
                              getVals.push({
                                opsi: "", data : [es, '=', `"${vals}"`]
                              })
                            }else{
                              getVals.push({
                                opsi: "AND", data : [es, '=', `"${vals}"`]
                              })
                            }
                            n++;
                          }


                          AuditDev(datalogin)
                          .table(loadForm.data.table)
                          .condition(getVals)
                          .get(function(a, b){
                            if (Number(b) > 0 ) {


                              var keysRow = Object.keys(loadForm.data.objform);
                              var objUpdt = {}
                              for(const lpp of keysRow){
                                if (loadForm.data.objform[lpp].type == "select") {
                                  document.getElementById(lpp).value = a[0][lpp];
                                  $('#'+lpp).val(a[0][lpp]).trigger('change');
                                }else if(loadForm.data.objform[lpp].type == "number"){
                                  document.getElementById(lpp).value = formatRupiah(a[0][lpp]);
                                }else{
                                  document.getElementById(lpp).value = a[0][lpp];
                                }
                                objUpdt[lpp] = a[0][lpp];
                              }

                              if (loadForm.data.onupdate != undefined) {
                                loadForm.data.onupdate(loadForm, a, new AuditDev(datalogin));
                              }

                              document.getElementById(idm).innerText = 'Ubah '+title;
                              loadForm.data.loadDataEdit = objUpdt;
                              loadForm.data.idUpdate = true;
                              document.getElementById(hapus).style.display = 'inline-block';
                            }else{
                              document.getElementById(idm).innerText = 'Tambah '+title;
                              loadForm.data.loadDataEdit = {};
                              loadForm.data.idUpdate = null;
                              document.getElementById(hapus).style.display = 'none';
                              var keysRow = Object.keys(loadForm.data.objform);
                              for(const lpp of keysRow){
                                if (loadForm.data.equals.indexOf(lpp) == -1) {
                                  document.getElementById(lpp).value = '';
                                  if (loadForm.data.oncreate != undefined) {
                                    loadForm.data.oncreate(loadForm, new AuditDev(datalogin));
                                  }
                                  if (loadForm.data.objform[lpp].type == "select") {
                                    $('#'+lpp).val(null).trigger('change');
                                  }
                                }
                              }

                            }
                          })

                        },500), false)
                      }
                    }
                    document.getElementById(loadForm.data.idData[0]).focus()
                    for(const dataid of loadForm.data.idData){
                      // if define equals cek data
                      // action form

                      var getredirect = dataid;
                      if (loadForm.data.objform[dataid].type == 'select') {
                        getredirect = 'search-choice-'+dataid;
                        document.getElementById('search-choice-'+dataid).addEventListener('keyup', function(){
                          var relations = null;
                          if(loadForm.data.objform[dataid].relation != undefined){
                            relations = loadForm.data.objform[dataid].relation;
                          }
                          document.getElementById('choice-'+dataid).innerHTML = globalThis.listdata[dataid](this.value, relations);
                          globalThis.actionListNew[dataid]();
                        },false)

                      }

                      if (loadForm.data.objform[dataid].type == 'slug') {
                        document.getElementById(dataid).addEventListener('focus', function(){
                          var getValFrom = document.getElementById(loadForm.data.objform[dataid].from).value;
                          this.value = getValFrom.replace(/ /g,'-')
                          .replace(/\#/g,'')
                          .replace(/\'/g,'')
                          .replace(/\"/g,'')
                          .replace(/\&/g,'')
                          .replace(/\^/g,'')
                          .replace(/\@/g,'')
                          .replace(/\!/g,'')
                          .replace(/\~/g,'')
                          .replace(/\*/g,'')
                          .replace(/\;/g,'')
                          .replace(/\:/g,'')
                          .replace(/\{/g,'')
                          .replace(/\}/g,'')
                          .replace(/\,/g,'')
                          .replace(/\./g,'')
                          .replace(/\)/g,'')
                          .replace(/\(/g,'')
                          .replace(/\%/g,'')
                          .replace(/\%/g,'')
                        }, false)
                      }

                      // --------- //
                      document.getElementById(getredirect).addEventListener('keypress', function(e){
                        if (e.key === 'Enter') {
                          if (loadForm.data.idData.indexOf(document.getElementById(dataid).id) != (loadForm.data.idData.length - 1)) {
                            var mop = loadForm.data.idData.indexOf(document.getElementById(dataid).id) + 1;
                            var nextr = loadForm.data.idData[mop];
                            if(loadForm.data.objform[nextr].type == 'note'){
                              $('#'+nextr).summernote('focus')
                              Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                elm.style.display = 'none';
                              })
                              Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                elm.style.display = 'none';
                              })
                            }else{
                              document.getElementById(loadForm.data.idData[mop]).focus();
                            }
                          }else{
                            document.getElementById(simpan).addEventListener('focus', function(){
                              Array.from(document.querySelectorAll('.select-choice')).forEach(function(elm, i){
                                elm.style.display = 'none';
                              })
                              Array.from(document.querySelectorAll('.select-search')).forEach(function(elm, i){
                                elm.style.display = 'none';
                              })
                            }, false)
                            setTimeout(function(){
                              document.getElementById(simpan).focus();
                            },100)
                          }
                        }
                      }, false)
                    }
                  },100)
                })
              }, false);
            }
            return this;
        },
        loadData: function(dat){
            var disableNew = false;
            if(this.data.disableCreateR == true){
                disableNew = true;
            }
            var pagination = this.data.pagination;
            var bataspagin = this.data.bataspagin;
            var totData = this.data.totData;
            var objform = this.data.objform;
            var t = this.data.id;
            var m = this.data.row;
            var k = Object.keys(this.data.row);
            globalThis.act = this;

            if(act.data.addRow != undefined) {
                setTimeout(function(){
                    globalThis.actAddRow = function(){
                        var dataLoad = dat.map(function(resData){
                            for (let l = 0; l < k.length; l++) {
                                if (l == (k.length - 1)) {
                                    if (act.data.addRow != undefined) {
                                        var objAddRow = Object.keys(act.data.addRow);
                                        objAddRow.map(function(er){
                                            var id = act.data.addRow[er].id;
                                            var key = act.data.addRow[er].key;
                                            for(const placeEf of key){
                                                var ty = '{{'+placeEf+'}}';
                                                id = id.replaceAll(ty, resData[placeEf]);
                                            }
                                            if (act.data.addRow[er].click != undefined) {
                                                document.getElementById(id).addEventListener('click', act.data.addRow[er].click, false)
                                            }
                                            if (act.data.addRow[er].load != undefined) {
                                                act.data.addRow[er].load(resData, act, text2Binary(resData));
                                            }
                                        })
                                    }
                                }
                            }
                        })
                    }
                })
            }
            //console.log(dat);
            var dataLoad = dat.map(function(resData, r){
                var lop = '';
                for (let l = 0; l < k.length; l++) {
                    var lopin = resData[k[l]];
                    var align = "left";
                    if (objform[k[l]] != undefined) {
                        if (objform[k[l]].type != undefined) {
                            if (objform[k[l]].type == 'date') {
                                lopin = tanggal(resData[k[l]]).sekarang;
                                align = "center";
                            }else if(objform[k[l]].type == 'number'){
                                lopin = formatRupiah(resData[k[l]]);
                                align = "right";
                            }else{
                                lopin = resData[k[l]];
                            }
                        }else{
                            lopin = resData[k[l]];
                        }
                    }else{
                        lopin = resData[k[l]];
                    }
                    if (act.data.none != undefined) {
                        if (act.data.none.indexOf(l) != -1) {
                            if(act.data.disableCreateR == false){
                              lop += `
                              <div data-row-${l} style="display:flex; align-items:center; font-size: 14px; cursor: pointer;text-align: ${align}; display: none;" data-update${t}="${text2Binary(resData)}">${lopin}</div>
                              `;
                            }else{
                              lop += `
                              <div data-row-${l} style="display:flex; align-items:center; font-size: 14px; cursor: pointer;text-align: ${align}; display: none;" >${lopin}</div>
                              `;
                            }
                        }else{
                            if(act.data.disableCreateR == false){
                              lop += `
                              <div data-row-${l} style="display:flex; align-items:center; font-size: 14px; cursor: pointer;text-align: ${align};" data-update${t}="${text2Binary(resData)}">${lopin}</div>
                              `;
                            }else{
                              lop += `
                              <div data-row-${l} style="display:flex; align-items:center; font-size: 14px; cursor: pointer;text-align: ${align};">${lopin}</div>
                              `;
                            }
                        }
                    }else{
                      if(act.data.disableCreateR == false){
                        lop += `
                        <div data-row-${l} style="display:flex; align-items:center; font-size: 14px; cursor: pointer;text-align: ${align};" data-update${t}="${text2Binary(resData)}">${lopin}</div>
                        `;
                      }else{
                        lop += `
                        <div data-row-${l} style="display:flex; align-items:center; font-size: 14px; cursor: pointer;text-align: ${align};">${lopin}</div>
                        `;
                      }
                    }
                    if (l == (k.length - 1)) {
                        if (act.data.addRow != undefined) {
                            var objAddRow = Object.keys(act.data.addRow);
                            lop += objAddRow.map(function(er){
                                var key = act.data.addRow[er].key;
                                var ef = act.data.addRow[er].template;
                                for(const placeEf of key){
                                    var ty = '{{'+placeEf+'}}';
                                    ef = ef.replaceAll(ty, act.decodeHtml(resData[placeEf]));
                                    var uptd = "{{updateid}}";
                                    ef = ef.replaceAll(uptd, `data-update${t}="${text2Binary(resData)}"`);
                                    ef = ef.replaceAll("{{times}}", Date.now());
                                }
                                var style = '';
                                if (act.data.addRow[er].position != undefined) {
                                    style += 'text-align: '+act.data.addRow[er].position+';';
                                }
                                return ` <div style="${style}" id="head-'${t}'">${ef}</div> `;
                            }).join("")
                        }
                    }
                }
                return lop;
            }).join("")
            var setGrid = k.map(function(lp, r){
                if (act.data.none != undefined) {
                    if (act.data.none.indexOf(r) != -1) {

                    }else{
                        return "auto";
                    }
                }else{
                    return "auto";
                }
            }).join(" ")
            var setGridName = k.map(function(lp, r){
                var lopin = m[lp];
                if (act.data.none != undefined) {
                    if (act.data.none.indexOf(r) != -1) {
                        return '<div id="head-'+t+'" data-head-'+r+' class="head" style="display: none;">'+lopin+'</div>';
                    }else{
                        return '<div id="head-'+t+'" data-head-'+r+' class="head">'+lopin+'</div>';
                    }
                }else{
                    return '<div id="head-'+t+'" data-head-'+r+' class="head">'+lopin+'</div>';
                }
            }).join(" ")
            if (act.data.addRow != undefined) {
                var objAddRow = Object.keys(act.data.addRow);
                setGrid += ' '+objAddRow.map(function(er){
                    return 'auto';
                }).join(" ")
                setGridName += objAddRow.map(function(er){
                    var ef = act.data.addRow[er].title;
                    return ` <div id="head-'${t}'" class="head">${ef}</div> `;
                }).join("")
            }

            var wrap = 'white-space: nowrap;';

            if (act.data.wrap != undefined) {
                wrap = act.data.wrap;
            }

            var loadTable = `
            <div class="form-e">
                <style>
                    #${t}{
                        display: grid;
                        grid-template-columns: ${setGrid};
                        overflow-y: auto;
                    }
                    #${t} > div{
                        font-size: 8pt;
                        padding: 5px 8px;
                        border: 1px solid #ddd;
                        color: #333;

                    }
                    #${t} .head{
                        background: #77f;
                        color: white;
                        text-align: center;
                    }
                    .form-group-2{
                      margin: 0;
                    }
                    .bottom-nav{
                      margin-bottom: -30px;
                    }

                    .search-table{
                      float: right;
                      padding: 4px 8px;
                      border: 1px solid #aae;
                      border-radius: 4px;
                    }

                    .head{
                        cursor: pointer;
                        font-size: 11pt !important;
                        font-weight: bold;
                    }

                    .page-item .page-link:nth-child(1){
                      margin-right: 8px;
                    }

                    .page-item .page-link{
                      padding: 8px 15px;
                    }

                    .select2-container{
                        display: block;
                    }

                    .note-group-select-from-files{
                    //   display: none;
                    }

                    .form-group-2{
                      width: 100%;
                      margin-bottom: 8px;
                    }

                    .form-group-2::after{
                      content: "";
                      display: block;
                      clear: both;
                    }

                    .form-group-2 label{
                      float: left;
                      width: 100px;
                      font-size: 9pt;
                    }

                    .form-group-2 .form-control-2{
                      width: calc(100% - 100px);
                    }

                    .form-control-2{
                      font-size: 9pt;
                    }

                    select.form-control-2 {
                        height: 25px;
                    }

                    .form-group-2{
                      display: relative;
                    }

                    .form-group-2 .select-choice div{
                        white-space: nowrap;
                        border-bottom: 1px solid #ddd;
                    }

                    .eypass{
                      position: absolute;
                      top: 5px;
                      right: 20px;
                      z-index: 2;
                      cursor: pointer;
                    }

                    .form-group-2 .select-choice{
                        position: absolute;
                        top: calc(100% + 20px);
                        left: 110px;
                        display: none;
                        height:auto;
                        max-height: 250px;
                        width: wrap-content;
                        min-width: calc(100% - 100px);
                        background: white;
                        border-radius: 4px;
                        z-index: 99;
                        box-shadow: 0 0 10px rgba(1235,125,125,0.5);
                        overflow-y: auto;
                        padding: 10px 28px;
                    }

                    .label-select::after{
                      content: "";
                      position: absolute;
                      width: calc(100% - 100px);
                      background: transparent;
                      display: block;
                      height: 100%;
                      top:0;
                      right: 0;
                    }

                    .select-search{
                      width: calc(100% - 100px);
                      display: none;
                      position: absolute;
                      top: calc(100% - 10px);
                      z-index: 999;
                      padding: 3px 10px;
                      margin: 0;
                      height: 30px;
                      left: 110px;
                      border: 1px solid #ddd;
                    }

                    .modal-xl{
                        min-width: calc(100% - 40px);
                    }

                    .modal-xl .modal-body{
                      max-height: calc(100vh - 200px);
                      overflow: auto;
                    }

                    .form-d{
                      display: none;
                    }

                    @media screen and (max-width: 1024px){
                      .head-seach input{
                        width: 100%;
                      }
                      .head-seach{
                        margin-bottom: 10px;
                      }

                    }

                    .disabled-form{
                      position: absolute;
                      width: 100%;
                      height: 100%;
                      background: transparent;
                      z-index: 999;
                      top: 0;
                      left: 0;
                    }


                    .head-seach{
                      display: grid;
                      grid-template-columns: auto auto;
                    }

                    @media screen and (max-width: 1024px){
                      .head-seach{
                        display: grid;
                        grid-template-columns: auto;
                      }
                    }



                    .bottom-nav{
                      float: right;
                      margin-bottom: 5px;
                    }

                    .bottom-nav::after{
                      content: "";
                      clear: both;
                    }

                    .form-group-2{
                      position: relative;
                    }

                    .form-control-2{
                      display: block;
                      padding: 8px 12px;
                      outline: none;
                      border: none;
                      background: #f5f8fa;
                      border-radius: 4px;
                      color: #5e6278;
                      font: inherit;
                    }
                    select.form-control-2{
                      -webkit-appearance: menulist-button;
                      display: block;
                      padding: 8px 12px;
                      outline: none;
                      height: 35px;
                      border: none;
                      background: #f5f8fa;
                      border-radius: 4px;
                      color: #5e6278;
                    }

                    .form-control-2 > option{
                      height: 18px;
                    }

                    .form-group-2{
                      display: grid;
                      grid-template-columns: 100px calc(100% - 100px);
                    }

                    .form-group-2 div input{
                      min-width: 100%;
                      max-width: 100%;
                    }

                    .form-group-2 div .select2{
                      min-width: 100%;
                      max-width: 100%;
                    }

                    .form-control-2{
                      border: 1px solid #aaa;
                    }

                    input.form-control-2[readonly=true]{
                      border: 1px solid #aaa;
                      background: #ddd;
                    }

                    .table-bordered td,.table-bordered th{
                      border: 1px solid #ddd;
                    }

                    .table-bordered{
                      border: 1px solid #ddd;
                    }

                    .note-btn{
                      padding: 5px !important;
                    }

                    .dropdown-toggle::after{
                      display: none;
                    }


                </style>
            `;
            var newCreateBtn = '';
            if (disableNew == false) {
                newCreateBtn = `
                <div id='button-area'>
                    <button class="btn btn-sm btn-primary mb-3" id="tambah-${t}">Tambah</button>
                    <button onclick="globalThis.orderTmenus('${t}order')" class="btn btn-sm btn-primary mb-3"> <i class="fas fa-sort"></i> </button>
                    ${act.data.customeH}
                </div>
                `;
                if (act.data.search != undefined) {
                    newCreateBtn += `
                    <div id='search-area'>
                        <input id="cari-${t}" class="search-table" value="${act.data.search}" placeholder="enter for search">
                    </div>
                    `;
                }else{
                    newCreateBtn += `
                    <div  id='search-area'>
                        <input id="cari-${t}" class="search-table" placeholder="enter for search">
                    </div>
                    `;
                }
            }
            var back =  '';
            if (act.data.back != undefined) {
                back = `
                    <button class="btn btn-light mt-3" onclick="location.href='#/${act.data.back}'">kembali</button>
                `;
            }

            act.data.tottb = Math.ceil(totData[act.data.table] / bataspagin);

            var setContentData = `
                <div id="${t}">
                    ${setGridName}
                    ${dataLoad}
                </div>
            `;

            if(act.data.customeView != undefined){
                if(act.data.customeView == true){
                    setContentData = `
                        <div id="custome-${t}">
                        </div>
                    `;
                }
            }

            loadTable += `
            <div class="head-seach">
                ${newCreateBtn}
                <div style="clear:both;"></div>
            </div>
            ${setContentData}
            ${back}
            <div class="float-right bottom-nav">
                 <ul class="pagination mt-3">
                  <li><span style="display: inline-block;padding: 8px 10px;">halaman ${(Number(pagination[act.data.table]) + bataspagin) / bataspagin } dari ${Math.ceil(totData[act.data.table] / bataspagin)} </span></li>
                  <li><input type="text" id="goval-${t}" class="form-control" style="width:80px; margin: 0 10px;" value="${(Number(pagination[act.data.table]) + bataspagin) / bataspagin }" /></li>
                  <li><button class="btn btn-primary mr-2" id="go-${t}">GO</button></li>
                  <li class="page-item"><a id="prev-${t}" style="cursor: pointer;" class="page-link"><</a></li>
                  <li class="page-item"><a id="next-${t}" style="cursor: pointer;" class="page-link">></a></li>
                </ul>
            </div>
            </div>
            `;
            // make modal
            loadTable += `
                <div class="form-d">
                    <h5 class="modal-title" id="m${t}"></h5>
                    <br>
                    <div class="row" id="form-get-app${t}"></div>
                    <div class="text-right">
                    <button id="close${t}" type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button id="hapus${t}" type="button" class="btn btn-danger">Hapus</button>
                    <button id="simpan${t}" type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            `;
            if (dat.length == 0) {
                loadTable += `
                    <div class="text-center pd-5 pt-3">
                        Belum ada data inputan
                    </div>
                `;
            }


            var orderForm = Object.keys(act.data.row).map((er)=>{

                var opt = [
                    {value: '', data: 'Pilih Order'}
                    ,{value: 'ASC', data: 'ASC'}
                    ,{value: 'DESC', data: 'DESC'}
                ];

                var setVal = '';

                var cekDOrder = act.data.multiOrder.filter((e,o)=>{
                    if(e.name == er){
                        return e;
                    }
                })

                if(cekDOrder.length > 0){
                    setVal = cekDOrder[0].val;
                }

                var makeSelection = opt.map(function(cj,i){
                    if(setVal == cj.value){
                        return `
                            <option selected value="${cj.value}">${cj.data}</option>
                        `;
                    }else{
                        return `
                            <option value="${cj.value}">${cj.data}</option>
                        `;
                    }
                })

                return `
                    <div class="form-group row">
                        <div class="col-6">
                            ${act.data.row[er]}
                        </div>
                        <div class="col-6">
                            <select class="form-control" data-order-f-${t}="${er}" id="order-${er}">
                                ${makeSelection}
                            </select>
                        </div>
                    </div>
                `;
            }).join(' ')

            loadTable += `
                <div id="${t}order" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Order Table</h5>
                            <button onclick="globalThis.closeModalOrder('${t}order')" type="button" class="btn btn-sm btn-primary" style="display: flex; align-items:center;height:30px;;padding: 0;background: transparent;margin:0;" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: #333;font-size:32px;margin: 0;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ${orderForm}
                        </div>
                        <div class="modal-footer">
                            <button onclick="globalThis.loadFilterOrder('data-order-f-${t}', '${t}order')" type="button" class="btn btn-primary">Order</button>
                        </div>
                        </div>
                    </div>
                </div>
            `;

            globalThis.closeModalOrder = function(id){
                $('#'+id).modal('toggle');
            }

            globalThis.orderTmenus = function(id){
                $('#'+id).modal('show');
            }

            globalThis.loadFilterOrder = function(s, id){
                var getVal = Array.from(document.querySelectorAll('['+s+']')).map((m,n)=>{
                    var name = m.getAttribute(s);
                    var val = m.value;
                    return {
                        name: name,
                        val: val
                    }
                })

                getVal = getVal.filter((s)=>{
                    if(s.val != ''){
                        return s;
                    }
                })

                $('#' + id).modal('toggle');

                act.data.multiOrder = getVal;

                act.load();

            }


                // console.log('cek l')
            if (this.data.afterload != undefined) {
              function loadSfIle(edt = null){
                document.getElementById('load-'+tableName).innerHTML = loadTable;
                if(edt == null){
                    act.newData();
                }else{
                    act.updateShown(edt)
                }
                if(act.data.addRow != undefined) {
                  setTimeout(function(){
                    actAddRow();
                  },500)
                }
              }
              function newAct(){
                  act.newData();
              }
              this.data.afterload(act, new AuditDev(datalogin), loadSfIle, newAct);
            }else{
              document.getElementById('load-'+tableName).innerHTML = loadTable;
              act.newData();
              if(act.data.addRow != undefined) {
                setTimeout(function(){
                  actAddRow();
                },500)
              }
            }
        }
        ,load: function(){
            var t = this.data.id;
            var m = this.data.row;
            var k = Object.keys(this.data.row);
            globalThis.act = this;
            document.getElementById('load-'+tableName).style.minHeight = '50vh';
            document.getElementById('load-'+tableName).innerHTML = `
            <div class="row">
                <div class="col-12 text-center">
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                    <p>please wait...</>
                </div>
            </div>
            `;

            if(act.data.pagination == undefined){
                act.data.pagination = {};
            }

            if(act.data.pagination[this.data.table] == undefined){
                act.data.pagination[this.data.table] = 0;
            }

            if (act.data.totData == undefined) {
                act.data.totData = {}
            }

            var tbl = this.data.table;

            var objLike = [];
            var si = 0;
            if (this.data.search != undefined) {
                var searchKey = Object.keys(this.data.row);
                searchKey = searchKey.concat(act.data.searchKey)
                for(const mLIke of searchKey){
                    if (si == 0) {
                        objLike.push({
                            opsi: "", data: [mLIke, 'LIKE', `"%${this.data.search}%"`]
                        });
                    }else{
                        objLike.push({
                            opsi: "OR", data: [mLIke, 'LIKE', `"%${this.data.search}%"`]
                        });
                    }
                    si++;
                }
            }

            var lpsTable = AuditDev(datalogin);
            // console.log(act.data.groupby);
            if(act.data.groupby != undefined){
              lpsTable.group(act.data.groupby);
            }

            if(act.data.filter != undefined){
                var cndObj = Object.keys(act.data.filter);
                var condT = [];
                var numc = 0;
                for(const cndu of cndObj){
                    if (numc == 0) {
                        if(act.data.filter[cndu].toString().indexOf('||') != -1){
                            var u = act.data.filter[cndu].toString().replace(/\|/g, "");
                            condT.push({
                                opsi: '', data: ['('+cndu, '=', '"'+u+'"']
                            });
                            condT.push({
                                opsi: 'OR', data: [cndu, '=', '"" )']
                            });
                        }else{
                            condT.push({
                                opsi: '', data: [cndu, '=', '"'+act.data.filter[cndu]+'"']
                            });
                        }
                    }else{
                        if(act.data.filter[cndu].toString().indexOf('||') != -1){
                            var u = act.data.filter[cndu].toString().replace(/\|/g, "");
                            condT.push({
                                opsi: 'AND', data: ['('+cndu, '=', '"'+u+'"']
                            });
                            condT.push({
                                opsi: 'OR', data: [cndu, '=', '"" )']
                            });
                        }else{
                            condT.push({
                                opsi: 'AND', data: [cndu, '=', '"'+act.data.filter[cndu]+'"']
                            });
                        }
                    }
                    numc++;
                }

                if(this.data.condCus.length > 0){
                    var c = 0;
                    for(var cust of this.data.condCus){
                        condT.push(cust);
                    }
                }

                lpsTable.condition(condT)
            }

            lpsTable.table(this.data.table)
            if (objLike.length != 0) {
                lpsTable.like(objLike)
            }

            if (act.data.select != undefined) {
                var select = act.data.select.join(",");
                lpsTable.select(select);
            }

            // console.log(act.data.bataspagin)
            if(act.data.bataspagin == undefined){
              act.data.bataspagin = 10;
            }

            lpsTable.limit(act.data.pagination[this.data.table], Math.floor(act.data.bataspagin))

            if (act.data.multiOrder.length == 0) {
                if (act.data.order != undefined) {
                    act.data.multiOrder.push({
                        name: act.data.order.start,
                        val: act.data.order.end
                    })
                }
            }

            if (act.data.multiOrder.length > 0) {

                lpsTable.order(act.data.multiOrder.map(function(nj,i){
                    return ` ${nj.name} ${nj.val} `;
                }).join(','), '');
            }

            lpsTable.get(function(dat, tot){
                act.data.totData[tbl] = tot;
                //console.log('aaaa')
                globalThis.dataLoadtable = dat;
                // console.log('awesome')
                act.loadData(dat);
            })
        }
    }
}
