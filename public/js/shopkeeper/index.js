// pagination to prodcut
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href');
            console.log(page);
            window.location.href = page;

        });

        // delete product
        // done
        function deleteproductdata(id, name) {
            document.getElementById("deletenameproduct").textContent = name;
            document.getElementById("deleteid").value = id;
        }

        // password
        function passwordshow() {
            $("#passwordhidden").removeAttr("hidden");
            $("#passwordshow").attr("hidden", true);
            document.getElementById('password').type = 'text';
        }

        function passwordhidden() {
            $("#passwordshow").removeAttr("hidden");
            $("#passwordhidden").attr('hidden', true);
            document.getElementById('password').type = 'password';
        }

        // config password
        function conformpasswordshow() {
            $("#conformpasswordhidden").removeAttr("hidden");
            $("#conformpasswordshow").attr("hidden", true);
            document.getElementById('conpassword').type = 'text';
        }

        function conformpasswordhidden() {
            $("#conformpasswordshow").removeAttr("hidden");
            $("#conformpasswordhidden").attr('hidden', true);
            document.getElementById('conpassword').type = 'password';

        }

        $("#showProductdiv").on("click", function() {
            if (localStorage.getItem('categoryShowStore') == 'Show') {
                localStorage.clear();

                $("#product1").attr("hidden", true);
                $("#hideProduct").attr("hidden", true);
                $("#showProduct").removeAttr("hidden");
            } else {

                localStorage.setItem('categoryShowStore', 'Show');

                $("#product1").removeAttr("hidden");
                $("#hideProduct").removeAttr("hidden");
                $("#showProduct").attr("hidden", true);
            }

        })

        $(document).ready(function() {

            // show categoryShowStore
            if (localStorage.getItem('categoryShowStore') == 'Show') {

                console.log(localStorage.getItem('categoryShowStore'));
                $("#product1").removeAttr("hidden");
                $("#hideProduct").removeAttr("hidden");
                $("#showProduct").attr("hidden", true);
            }


            $("#file-input").on("change", function() {
                var files = $(this)[0].files;
                $("#preview-container").empty();
                if (files.length > 0) {
                    for (var i = 0; i < files.length; i++) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("<div class='preview'><img src='" + e.target.result + "'><button class='delete'>Delete</button></div>").appendTo("#preview-container");
                        };
                        reader.readAsDataURL(files[i]);
                    }
                }
            });
            $("#preview-container").on("click", ".delete", function() {
                $(this).parent(".preview").remove();
                $("#file-input").val("");
            });
        });

        (function() {

            'use strict';

            $('.input-file').each(function() {
                var $input = $(this)
                    , $label = $input.next('.js-labelFile')
                    , labelVal = $label.html();

                $input.on('change', function(element) {
                    var fileName = '';
                    if (element.target.value) fileName = element.target.value.split('\\').pop();
                    console.log(fileName);

                    fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html("labelVal");
                });
            });

        })();