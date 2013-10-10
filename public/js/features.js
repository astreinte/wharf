/**
 * relatedDivisions
 */
var relatedDivisions = {
    config: {
        container: '#division',
        trigger: '#group',
        select: '.division-select',
        urlBase: 'url',
        edit: false,
        divisionId: undefined
    },

    init: function (config) {
        $.extend(relatedDivisions.config, config);
        if (relatedDivisions.config.edit) {
            relatedDivisions.getContent();
        }
        $(relatedDivisions.config.trigger).change(function () {
            relatedDivisions.clearContent();
            relatedDivisions.getContent();
        });
    },

    urlBuilder: function () {
        return relatedDivisions.config.urlBase + $(relatedDivisions.config.trigger).val();
    },

    clearContent: function () {
        $(relatedDivisions.config.container).html('<option value="">- Sélectionner une Division -</option></select>');
    },

    getContent: function () {
        if ($(relatedDivisions.config.trigger).val() != '') {
            var url = relatedDivisions.urlBuilder();
            $.get(url, function (data) {
                if (data != '') {
                    $.each(data, function (i) {
                        relatedDivisions.showContent(data, i);
                        $(relatedDivisions.config.select).slideDown();
                    });
                    $(relatedDivisions.config.container).selectpicker('refresh');
                } else {
                    $(relatedDivisions.config.select).slideUp();
                }
            });
        } else {
            $(relatedDivisions.config.select).slideUp();
        }
    },

    showContent: function (data, i) {
        if (relatedDivisions.config.divisionId == data[i].id) {
            $(relatedDivisions.config.container).append('<option selected="selected" value="' + data[i].id + '">' + data[i].name + '</option>');
        } else {
            $(relatedDivisions.config.container).append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
        }
    }

};

/**
 * specificDivision
 */
var specificDivision = {
    config: {
        trigger: '.group-add-action a',
        input: '.group-add-division input',
        container: '.group-add-division',
        list: '.division-list'
    },

    save: false,
    i: 0,

    init: function (config) {
        $.extend(specificDivision.config, config);
        $(specificDivision.config.trigger).click(function () {
            var that = $(this);
            if (specificDivision.save) {
                specificDivision.showContent(that);
            } else {
                specificDivision.hideContent(that);
            }
        });
    },

    showContent: function (that) {
        var value = $(specificDivision.config.input).val();
        if ($.trim(value).length == 0) {
            return false;
        }
        $(specificDivision.config.list).append('<input id="division' + specificDivision.i + '" name="divisions[]" value="' + value + '" class="css-checkbox" checked="checked" type="checkbox" /><label for="division' + specificDivision.i + '" class="css-label">' + value + '</label>');
        $(specificDivision.config.input).val('');
        $(specificDivision.config.container).hide();
        $(that).html('Ajouter une division spécifique');
        specificDivision.save = !specificDivision.save;
        specificDivision.i++;
    },

    hideContent: function (that) {
        $(specificDivision.config.container).show();
        $(that).html('Ajouter');
        specificDivision.save = !specificDivision.save;
    }
};

/**
 * relatedProjects
 */
var relatedProjects = {
    config: {
        container: '#project',
        trigger: '#group',
        select: '.project-select',
        urlBase: 'url',
        edit: false,
        projectId: undefined
    },

    init: function (config) {
        $.extend(relatedProjects.config, config);
        if (relatedProjects.config.edit) {
            relatedProjects.getContent();
        }
        $(relatedProjects.config.trigger).change(function () {
            relatedProjects.clearContent();
            relatedProjects.getContent();
        });
    },

    urlBuilder: function () {
        return relatedProjects.config.urlBase + $(relatedProjects.config.trigger).val();
    },

    clearContent: function () {
        $(relatedProjects.config.container).html('<option value="">- Sélectionner un Projet-</option></select>');
    },

    getContent: function () {
        if ($(relatedProjects.config.trigger).val() != '') {
            var url = relatedProjects.urlBuilder();
            $.get(url, function (data) {
                if (data != '') {
                    $.each(data, function (i) {
                        relatedProjects.showContent(data, i);
                        $(relatedProjects.config.select).slideDown();
                    });
                    $(relatedProjects.config.container).selectpicker('refresh');
                } else {
                    $(relatedProjects.config.select).slideUp();
                }
            });
        } else {
            $(relatedProjects.config.select).slideUp();
        }
    },

    showContent: function (data, i) {
        if (relatedProjects.config.projectId == data[i].id) {
            $(relatedProjects.config.container).append('<option selected="selected" value="' + data[i].id + '">' + data[i].name + '</option>');
        } else {
            $(relatedProjects.config.container).append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
        }
    }

};

var makePrimary = {
    config: {
        trigger: '#makeprimary',
        container: '.primary',
        urlBase: 'url'
    },

    init: function (config) {
        $.extend(makePrimary.config, config);
        $(document).on('click', makePrimary.config.trigger, function (event) {
            var that = $(this);
            makePrimary.update(that);
            return false;
        });
    },

    update: function (that) {
        $.ajax({
            url: makePrimary.config.urlBase+that.data('id')+'/primary',
            success: function() {
                makePrimary.content(that); 
            }
        });
    },
    content: function (that) {
        $('.primary').each(function(){
            var primary = $(this).find('a');
            if(primary.html() == undefined)
            {
                var id = $(this).find('span').data('id');
                $(this).html('<a id="makeprimary" class="bold" data-id="'+id+'" href="#">Définir comme adresse principale</a>');
            }
        });
        $(that).parent().html('<span class="bold" data-id="'+$(that).data('id')+'">Adresse principale</span>');
    }
};

var quickSearch = {
    config: {
        trigger : '.quick-search',
        container : '.results',
        baseUrl : ''
    },

    init: function (config) {
        $.extend(quickSearch.config, config);

         $(quickSearch.config.trigger).keyup(function(e) {
            if (e.keyCode == 27){
                $(this).val('');
            }
            var search = $(this).val();
            $('.results').html('');
            if(search == ''){
                 $('.results').hide();
                 $('.main').show();
            }
            if(!search.length < 1){
                $('.search-load').show();
                $('.results').show();
                $('.main').hide();
                var url = quickSearch.config.baseUrl+search;
                $.get(url, function(data) {
                     $('.search-load').hide();
                     $(quickSearch.config.container).html(data);
                });
            }
        }); 
    }
};

var quickUsers = {
    config: {
        trigger : '.adduser input',
        container : '.user-results',
        baseUrl : '',
        addUrl : ''
    },

    init: function (config) {
        var url = config.baseUrl;
        $.extend(quickUsers.config, config);

         $(quickUsers.config.trigger).keyup(function(e) {
            if (e.keyCode == 27){
                $(this).val('');
            }
            var search = $(this).val();
            $(quickUsers.config.container).html('');
            if(search == ''){
                $(quickUsers.config.container).hide();
            }
            if(!search.length < 1){
               $.getJSON(
                    url + search,
                    null,
                    function(data) {
                        if(data.length<1)
                        {
                            $(quickUsers.config.container).hide();
                            $(quickUsers.config.container).html("");
                        }
                        else{
                            $(quickUsers.config.container).html("");
                            $.each(data, function(i){
                                $(quickUsers.config.container).append('<li><a data-id="'+data[i].id+'" class="adduser-link" href="#">'+data[i].profile.firstname+' '+data[i].profile.lastname+'</a></li>');
                            });
                        }
                        $(quickUsers.config.container).show();
                    }
                );       
            }
        });

        $(document).on("click", '.adduser-link', function ($e) {

          var url = quickUsers.config.addUrl + $(this).data('id') +'/add';
          $(quickUsers.config.trigger).val('');
          $('.loading-users').show();
          $.get(url, function(data){
            $(quickUsers.config.container).hide().html('');
           $('.project-users').html(data);
           $('.loading-users').hide();
          });
          return false;
        }); 
    }
};

var projectUpload = {
    config: {
        trigger : '.upload-file',
        container : '.project-upload',
        foldUrl : '',
        url : '',
        folder : undefined
    },

    init: function (config) {
        $.extend(projectUpload.config, config);
        var open = false;
        $(projectUpload.config.trigger).click(function(){
            if(open)
            {
                $(projectUpload.config.container).slideUp();
                $(projectUpload.config.trigger).html('<i class="icon-upload"></i> Uploader un fichier');
                open = false;
            }
            else
            {
                $(projectUpload.config.container).slideDown();
                $(projectUpload.config.trigger).html('<i class="icon-remove"></i> Fermer');
                open = true;
            }
            return false;
        });

        $(projectUpload.config.container).submit(function(){
            if($('#file-input').val() == '')
            {
                return false;
            }

            $('.loader').show();

            $('#upload_target').unbind().load( function(){
                $('.loader').hide();
                var response = $('#upload_target').contents().find('body').html();
                if(response == 'sent')
                {
                   $('.loading-files').show();
                   $.get(projectUpload.config.url, function(data)
                   {    
                      $('.loading-files').hide();
                      $('.project-documents').html(data);
                   });
                }
            });
        });

        $('#add-folder').click(function(){
             projectUpload.createFolder($('#folder-input').val()); 
             $('#folder-input').val('');
        });

        $('#folder-input').keyup(function(e){
             if(e.keyCode == 13) {
                projectUpload.createFolder($(this).val());
                $(this).val('');
             }
        });
    },

    createFolder: function(name)
    {
        $('.loading-files').show();
        $.get(projectUpload.config.foldUrl+name, function(data)
        {    
             $('.loading-files').hide();
             $('.project-documents').html(data);
       });
    }
};

var projectUpload = {
    config: {
        trigger : '.upload-file',
        container : '.project-upload',
        foldUrl : '',
        url : '',
        folder : undefined
    },

    init: function (config) {
        $.extend(projectUpload.config, config);
        var open = false;
        $(projectUpload.config.trigger).click(function(){
            if(open)
            {
                $(projectUpload.config.container).slideUp();
                $(projectUpload.config.trigger).html('<i class="icon-upload"></i> Uploader un fichier');
                open = false;
            }
            else
            {
                $(projectUpload.config.container).slideDown();
                $(projectUpload.config.trigger).html('<i class="icon-remove"></i> Fermer');
                open = true;
            }
            return false;
        });

        $(projectUpload.config.container).submit(function(){
            if($('#file-input').val() == '')
            {
                return false;
            }

            $('.loader').show();

            $('#upload_target').unbind().load( function(){
                $('.loader').hide();
                var response = $('#upload_target').contents().find('body').html();
                if(response == 'sent')
                {
                   $('.loading-files').show();
                   $.get(projectUpload.config.url, function(data)
                   {    
                      $('.loading-files').hide();
                      $('.project-documents').html(data);
                   });
                }
            });
        });

        $('#add-folder').click(function(){
             projectUpload.createFolder($('#folder-input').val()); 
             $('#folder-input').val('');
        });

        $('#folder-input').keyup(function(e){
             if(e.keyCode == 13) {
                projectUpload.createFolder($(this).val());
                $(this).val('');
             }
        });
    },

    createFolder: function(name)
    {
        $('.loading-files').show();
        $.get(projectUpload.config.foldUrl+name, function(data)
        {    
             $('.loading-files').hide();
             $('.project-documents').html(data);
       });
    }
};
var divisionUpload = {
    config: {
        trigger : '.upload-file',
        container : '.group-divisions',
        url : '',
        folder : undefined
    },

    init: function(config)
    {

        $.extend(divisionUpload.config, config);
        
        $('#add-division').click(function(){
             divisionUpload.createDivision($('#division-input').val()); 
             $('#division-input').val('');
        });

        $('#division-input').keyup(function(e){
             if(e.keyCode == 13) {
                divisionUpload.createDivision($(this).val());
                $(this).val('');
             }
        });
    },
    createDivision: function(name)
    {
        $('.loading-files').show();
        $.get(divisionUpload.config.url+name, function(data)
        {    
             $('.loading-files').hide();
             $(divisionUpload.config.container).html(data);
       });
    }
};

var rightsCheck = {

    init: function()
    { 
        $('.btn-all').click(function(){
            $('.checkright').prop('checked', true);
            return false;
        });
        $('.btn-folder').click(function(){
            var id = $(this).data('id');
            $('.checkright').prop('checked', false);
            $('#fold'+id).prop('checked', true);
            return false;
        });
    },
};

var versionUpload = {
    config: {
        trigger : '#upload-version',
        sub : '.version-sub',
        url : ''
    },

    init: function (config) {
        $.extend(versionUpload.config, config);
        var open = false;
        $(versionUpload.config.trigger).click(function(){
            if(open)
            {
                $(versionUpload.config.sub).slideUp();
                $(versionUpload.config.trigger).html('<i class="icon-plus"></i> Ajouter une version');
                open = false;
            }
            else
            {
                $(versionUpload.config.sub).slideDown();
                $(versionUpload.config.trigger).html('<i class="icon-remove"></i> Fermer');
                open = true;
            }
            return false;
        });

        $(versionUpload.config.sub).submit(function(){
            $('.upload-rules').removeClass('alert-danger');
            if($('#file-input').val() == '')
            {
                return false;
            }

            $('.loader').show();

            $('#upload_target').unbind().load( function(){
                $('.loader').hide();
                var response = $('#upload_target').contents().find('body').html();
                if(response == 'error')
                {
                    $('.upload-rules').addClass('alert-danger');
                }
                if(response == 'sent')
                {
                   $('.loading-doc').show();
                   $.get(versionUpload.config.url, function(data)
                   {    
                      $('.loading-doc').hide();
                      $('.document-content').html(data);
                      $('#version-name').val(versionUpload.vname());
                      var vbox = $('.versions-list li:first-child').find('a').attr('href');
                      $('.visu').attr('href', vbox);
                   });
                }
            });
        });
    },
    vname: function() {
     return ("000000" + (Math.random()*Math.pow(36,6) << 0).toString(36)).substr(-6)
    }
};

var commentUpload = {
    config: {
        trigger : '#post-discuss',
        container : '.doc-comments',
        url : ''
    },

    init: function (config) {
        $.extend(commentUpload.config, config);
        $(commentUpload.config.trigger).submit(function(){
            $('.message-label').removeClass('alert-error');
            $('.loading-discuss').show();
            $.post(commentUpload.config.url, $(commentUpload.config.trigger).serialize(), function(data){
                if(data == 'error-message'){
                    $('.message-label').addClass('alert-error');
                }
                else {
                  $(commentUpload.config.container).html(data);
                }
                $('.loading-discuss').hide();
            });
            return false;
        });
    }
};

var notify = {
    config: {
        trigger : '.notify',
        container : '.notify-count',
        url : ''
    },

    init: function (config) {
        $.extend(notify.config, config);
        var c = false;
        $(notify.config.trigger).click(function(){
            if(c)
            {
                $('.notifications li').removeClass('unchecked');
            }
            $(notify.config.container).remove();
            $.get(notify.config.url);
            c = true;
        });
    }
};

var switchDiscussions = {
    config: {
        open : '.open-d',
        close : '.close-d',
        open_container : '.open-discussions',
        close_container : '.closed-discussions'
    },

    init: function (config) {
        $.extend(switchDiscussions.config, config);
        $(switchDiscussions.config.open).click(function(){
            $(switchDiscussions.config.open_container).show();
            $(switchDiscussions.config.close_container).hide();
            return false;
        });
        $(switchDiscussions.config.close).click(function(){
            $(switchDiscussions.config.close_container).show();
            $(switchDiscussions.config.open_container).hide();
            return false;
        });
    }
};