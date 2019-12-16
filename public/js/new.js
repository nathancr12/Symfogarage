          $('#add-image').click(function(){
              //compter combien j'ai de form-group pour les indices ex: annonce_image_0_url
              const index = +$("#widget-counter").val(); // le + permet de transformaer en nombre pcq val() rend tjrs un type string

              // récup le prototype des entrées data_prototype
              const tmpl = $('#annonce_images').data('prototype').replace(/__name__/g, index)//drapeau g pour indiquer qu'on va le faire plusieurs fois 

            //injecter le code dans la div
            $('#annonce_images').append(tmpl);

            $('#widget-counter').val(index+1);

        // gérer le bouton supprimer

            handleDeleteButtons();

          });

            function updateCounter(){
                const count = +$('#annonce_image div.form-group').length;

                $('#widget-counter').val(count);
            }


          function handleDeleteButtons(){
              $('button[data-action="delete"]').click(function(){
                const target =this.dataset.target; //detaset(les attributs data et je veux le target)
                $(target).remove();
              
              });
          }

          updateCounter();
          handleDeleteButtons();
