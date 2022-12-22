(function(m){
    var par = m.cond(1,'type');
    var ma = _id("menus-area")
    var list = el('ul').class('nav nav-pills nav-sidebar flex-column')
    .data('widget', 'treeview')
    .data('accordion', false)
    .attr('role', 'menu')

    var html = '';
    
    par.forEach(function(q){
        var cekSub = menus.cond(q.nama, 'parent');
        if(cekSub.length > 0){
            html += `
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas ${q.icon}"></i>
                    <p>
    
                    ${q.nama}
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    ${cekSub.map(function(sb){
                        return `
                            <li class="nav-item">
                                <a href="/${sb.link}" class="nav-link">
                                    <i class="${q.icon} nav-icon"></i>
                                    <p>${sb.nama}</p>
                                </a>
                            </li>
                        `
                    }).join('')}
                </ul>
            </li>
            `
        }else{
            html += `
            <li class="nav-item">
                <a href="/${q.link}" class="nav-link ">
                    <i class="nav-icon ${q.icon}"></i>
                    <p>
    
                    ${q.nama}
                    </p>
                </a>
            </li>
            `
        }
    })
    
    list.html(html);
    ma.innerHTML = '';
    ma.appendChild(list.get());
    // console.clear()
    return '';
})(menus)