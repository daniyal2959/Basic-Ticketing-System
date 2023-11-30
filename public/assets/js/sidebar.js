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

$(document).ready(function() {
    $('#tenancy').select2({
        theme: 'tenancy',
        minimumResultsForSearch: -1,
        templateResult: state => {
            if (!state.id) {
                return state.text;
            }

            return state.title;
        }
    });
});

$('#tenancy').on("select2:select", function(e) {
    if( window.location.port !== '80' )
        window.location.href = `${window.location.protocol}//${window.location.hostname}:${window.location.port}/dashboard/companies/${e.currentTarget.value}`;
    else
        window.location.href = `${window.location.protocol}//${window.location.hostname}/dashboard/companies/${e.currentTarget.value}`;
});
