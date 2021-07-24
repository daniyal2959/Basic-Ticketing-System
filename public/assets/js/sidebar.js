document.querySelector('#nightMode').addEventListener('click', ()=>{
    /**
     * Night Mode Button
     */
    document.querySelector('#nightMode').classList.toggle('bg-primary');
    document.querySelector('#nightMode').classList.toggle('text-white');
    document.querySelector('#nightMode').classList.toggle('text-dark');

    /**
     * Sidebar
     */
    document.querySelector('#sidenav-main').classList.toggle('bg-dark');
    document.querySelectorAll('#sidenav-main p, #sidenav-main a').forEach( element =>{
        element.classList.toggle('text-white');
    } );
    document.querySelector('#sidenav-main').classList.toggle('bg-white');

    /**
     * Card
     */
    document.querySelectorAll('#panel .card').forEach( element =>{
        element.classList.toggle('bg-dark');
    } );
    document.querySelectorAll('#panel .card label').forEach( element =>{
        element.classList.toggle('text-white');
    } );
    document.querySelectorAll('#panel .card .form-control').forEach( element =>{
        element.classList.toggle('darkInputs');
    } );
    document.querySelectorAll('#panel .card .card-header').forEach( element =>{
        element.classList.toggle('bg-dark');
    } );
    document.querySelectorAll('#panel .card .card-header h3').forEach( element =>{
        element.classList.toggle('text-white');
    } );
    document.querySelectorAll('#panel .card .card-profile-stats, #panel .card .card-body > .text-center > *').forEach( element =>{
        element.classList.toggle('text-white');
    } );
    document.querySelectorAll('#panel .card .custom-file-label').forEach( element =>{
        element.classList.toggle('bg-dark');
        element.classList.toggle('border-0');
    } );

    /**
     * Tables
     */
    document.querySelectorAll('#panel table').forEach( element =>{
        element.classList.toggle('table-dark');
    } );
    document.querySelectorAll('#panel table thead').forEach( element =>{
        element.classList.toggle('thead-dark');
    } );
    document.querySelectorAll('#panel table thead').forEach( element =>{
        element.classList.toggle('thead-light');
    } );

    /**
     * Breadcrumb
     */
    let breadcrumb = document.querySelector('.breadcrumb');
    if( breadcrumb != undefined ) {
        breadcrumb.classList.toggle('bg-dark');
    }

    /**
     * Extras
     */
    let navLink = document.querySelector('#sidenav-main .nav-link.active');
    if( navLink != undefined ) {
        navLink.classList.toggle('activeDark');
    }

    /**
     * DropDowns
     */
    document.querySelectorAll('.dropdown-menu').forEach(element=>{
        element.classList.toggle('bg-dark');
    })

    document.querySelectorAll('.dropdown-menu > *, .dropdown-menu h6').forEach(element=>{
        element.classList.toggle('text-white');
    })
});
