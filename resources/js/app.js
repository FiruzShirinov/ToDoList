import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){

    // add a new row for list unit/item
    $('.create-list-unit').on('click', function(){
        var path = $('.list-all').data('path')
        var imgBtn = ''
        if (~path.indexOf('list-items')) {
            imgBtn = `
                <label class="btn btn-file">
                    <img src="" alt="" class="bg-light img-thumbnail object-fit-cover" style="width: 150px; height: 150px; image: cover">
                    <input type="file" name="image" style="display: none">
                </label>`
        }
        if ($('.list-all').find('li.added-li').length === 0) {
            $('.list-all').append(`
                <li class="list-group-item bg-white d-flex justify-content-between align-items-center added-li">
                    ${imgBtn}
                    <input type="text" class="form-control w-50 p-0 border-0 bg-white" style="box-shadow: none" id="name">
                    <div class="store text-success" style="cursor: pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </div>
                </li>
            `)
        }
        $('#name').trigger('focus')
    })

    // store the new list unit/item
    $('.list-all').on('click', '.store', function(){
        var name = $('#name').val()
        var path = $('.list-all').data('path')
        $.post(path, {name:name}, function(listUnit){
            var imgBtn = ''
            var listName = `<span class="list-name">${listUnit.name}</span>`
            if (~path.indexOf('list-units')) {
                listName = `<a href="list-items/${listUnit.id}" class="link-dark link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">
                                <span class="list-name">${listUnit.name}</span>
                            </a>`
            } else {
                imgBtn = `
                    <label class="btn btn-file">
                        <img src="" alt="" class="bg-light img-thumbnail object-fit-cover" style="width: 150px; height: 150px; image: cover">
                        <input type="file" name="image" data-id="${listUnit.id}" style="display: none">
                    </label>`
            }
            $('.added-li').remove()
            $('.list-all').append(`
                <li class="list-group-item bg-white d-flex justify-content-between align-items-center">
                    ${imgBtn}
                    ${listName}
                    <div class="d-flex end-column">
                        <div class="edit-menu" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                            </svg>
                        </div>
                        <div class="edit-buttons" style="display: none" data-list_unit_id="${listUnit.id}">
                            <div class="edit text-primary me-1" style="cursor: pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </div>
                            <div class="dropdown me-1">
                                <a class="btn btn-link p-0 share" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                        <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu p-0">

                                </ul>
                            </div>
                            <div class="delete text-danger me-1" style="cursor: pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                            </div>
                            <div class="close-edit-menu" style="cursor: pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </li>
            `)
        })
    })

    // display edit menu
    $('.list-all').on('click', '.edit-menu', function(){
        $(this).hide()
        $(this).parent().find('.edit-buttons').fadeIn('slow').addClass('d-flex')
    })

    // close edit menu
    $('.list-all').on('click', '.close-edit-menu', function(){
        $(this).closest('li').find('.edit-buttons').removeClass('d-flex').hide()
        $(this).closest('li').find('.edit-menu').fadeIn()
    })

    // display edit list unit/item buttons
    $('.list-all').on('click', '.edit', function(){
        var closestLi = $(this).closest('li')
        var nameVal = closestLi.find('.list-name').text()

        closestLi.find('a').removeAttr('href')

        closestLi.find('.list-name').html(`<input type="text" class="form-control w-50 p-0 border-0 bg-white" style="box-shadow: none" id="name" value="${nameVal}">`)
        $('#name').trigger('select')

        closestLi.find('.edit-buttons').removeClass('d-flex').hide()

        closestLi.find('.end-column').append(`
            <div class="update-buttons text-success d-flex">
                <div class="update text-success me-1" style="cursor: pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                    </svg>
                </div>
                <div class="remove-update-buttons" style="cursor: pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                    </svg>
                </div>
            </div>
        `)
    })

    // hide edit list unit/item buttons
    $('.list-all').on('click', '.remove-update-buttons', function(){
        var closestLi = $(this).closest('li')
        closestLi.find('.edit-menu').fadeIn('slow')
        closestLi.find('.update-buttons').remove()
    })

    // update list unit/item
    $('.list-all').on('click', '.update', function(){
        var name = $('#name').val()
        var closestLi = $(this).closest('li')
        var listUnit = closestLi.find('.edit-buttons').data('list_unit_id')
        var path = $('.list-all').data('path')
        closestLi.find('a').attr('href', `list-items/${listUnit}`)
        $.ajax({
            url: `${path}/${listUnit}`,
            type: 'PATCH',
            data: {name: name},
            success: function(result) {
                if (result === '1') {
                    closestLi.find('.edit-menu').fadeIn('slow')
                    closestLi.find('.list-name').html(name)
                    $('#name').remove()
                    $('.update-buttons').remove()
                }
            }
        })
    })

    // display users for sharing list unit
    $('.list-all').on('click', '.share', function(){
        var thisParent = $(this).parent()
        var closestLi = $(this).closest('li')
        var listUnit = closestLi.find('.edit-buttons').data('list_unit_id')
        $.get(`/get-available-users/${listUnit}`, function(users){
            thisParent.find('.dropdown-menu').empty()
            if (users.length > 0) {
                $.each(users, function(key, user){
                    thisParent.find('.dropdown-menu').append(`
                        <li class="dropdown-item" data-user_id="${user.id}" data-list_unit_id="${listUnit}" style="cursor: pointer">${user.name}</li>
                    `)
                })
            } else {
                thisParent.find('.dropdown-menu').append(`
                    <li class="px-3 py-1 w-100">Нет доступных пользователей</li>
                `)
            }
        })
    })

    // share list unit/item with another user
    $('.list-all').on('click', '.dropdown-item', function(){
        var user = $(this).data('user_id')
        var listUnit = $(this).data('list_unit_id')
        var closestLi = $(this).closest('li.list-group-item')
        $.post(`/share-list-unit-with-user/${listUnit}/${user}`, function(users){
            if (users.length > 0) {
                var joinedUsers = $.map(users, function(user){
                    return user.name;
                }).join(', ')
                if (closestLi.find('.shared-with').length === 0) {
                    closestLi.find('.end-column').prepend(`
                        <small><em><span class="me-2 shared-with">расшарен с ${joinedUsers}</span></em></small>
                    `)
                } else {
                    closestLi.find('.shared-with').html(`расшарен с ${joinedUsers}`)
                }
                $('.close-edit-menu').trigger('click')
            }
        })
    })

    // delete list unit/item
    $('.list-all').on('click', '.delete', function(){
        var $this = $(this)
        var closestLi = $this.closest('li')
        var listUnit = $this.parent().data('list_unit_id')
        var path = $('.list-all').data('path')
        if (confirm("Вы уверены что хотите удалить?")) {
            $.ajax({
                url: `${path}/${listUnit}`,
                type: 'DELETE',
                success: function(result) {
                    if (result === '1') {
                        closestLi.remove()
                    }
                }
            })
        }
    })

    // upload and display the image
    $('.list-all').on('change', "[name='image']", function(){
        var imageInput = $(this)
        var imgTag = $(this).closest('label').find('img')
        var id = imageInput.data('id')

        if (imageInput[0].files && imageInput[0].files[0]) {
            var image = imageInput[0].files[0]
            var reader = new FileReader()

            reader.onload = function (e) {
                imgTag.attr('src', e.target.result)
            }
            reader.readAsDataURL(image)

            var formData = new FormData()
            formData.append('image', image)

            $.ajax({
                url: `/images/${id}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(src) {
                    src = src.replace('public', 'storage')
                    imageInput.parent().find('img').attr('src', `/${src}`)
                    imageInput.parent().attr('title', 'Изменить картинку')
                    imageInput.parent().after(`
                        <div class="text-light text-bg-danger rounded px-1 delete-image" title="Удалить картинку" style="cursor:pointer; position: absolute; top: 130px; left: 140px">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </div>
                    `)
                }
            })
        }
    })

    // delete image
    $('.list-all').on('click', '.delete-image', function(){
        var thisButton = $(this)
        var imageInput = $(this).parent().find('input')
        var id = imageInput.data('id')
        $.ajax({
            url: `/images/${id}`,
            type: 'DELETE',
            success: function(result) {
                if (result === '1') {
                    imageInput.parent().find('img').attr('src', '')
                    imageInput.parent().attr('title', 'Добавить картинку')
                    thisButton.remove()
                }
            }
        })
    })
})
