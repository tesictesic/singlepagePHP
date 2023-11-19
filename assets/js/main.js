console.log(document.location.pathname);
function ajaxCallBack(puna_adresa,objekat,rezultat){
    $.ajax({
        url:puna_adresa,
        method:"POST",
        data:objekat,
        success:rezultat,
        error:function(xhr){
            console.log(xhr);

        }
    })
}
function ajaxCallBack2(puna_adresa,objekat,rezultat){
    $.ajax({
        url:puna_adresa,
        method:"post",
        data:objekat,
        success:rezultat,
        processData: false,
        contentType: false,
        error:function(xhr){
            console.log(xhr);
        }
    })
}
function ProveraRegexom(regex,input){
    if(!regex.test(input.value)){
        input.nextElementSibling.classList.remove("dj-t-none");
        input.nextElementSibling.classList.add("dj-t-color-red");
        input.classList.add("dj-t-border-red");
        brGresaka++;
    }
    else{
        input.nextElementSibling.classList.add("dj-t-none");
        input.nextElementSibling.classList.remove("dj-t-color-red");
        input.classList.remove("dj-t-border-red")
    }
}
const regexName = /^[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}(\s[A-ZŠĐŽĆČ][a-zšđžćč]{2,15})?$/;
const regexEmail=/^([a-z]{3,11}(\d)*)(\.)?([a-z]{3,11}(\d)*)\@(gmail.com|hotmail.com|yahoo.com|outlook.com)$/;
const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
const regexFullName = /^([A-ZŠĐŽĆČ][a-zšđžćč]{2,15})\s([A-ZŠĐŽĆČ][a-zšđžćč]{2,15}){0,2}$/;
const regexAddress = /^[\w\.]+(,?\s[\w\.]+){2,8}$/;
const regexSubject=/^[A-zšđžćč]{3,}$/
var slajder = document.querySelector('.slider');
if(slajder!=null){
    var slike = slajder.getElementsByTagName('img');
    var trenutniSlajd = 0;

    function promijeniSlajd() {
        slike[trenutniSlajd].style.display = 'none';
        trenutniSlajd = (trenutniSlajd + 1) % slike.length;
        slike[trenutniSlajd].style.display = 'block';
    }

    setInterval(promijeniSlajd, 5000);
}

var dugme_registracija=document.querySelector("#registracija_btn");

if(dugme_registracija!=null){
    var brGresaka;
    dugme_registracija.addEventListener("click",DohvatanjeForme);
    function DohvatanjeForme(){
        brGresaka=0;
        let first_name_input=document.querySelector("#first_name");
        let last_name_input=document.querySelector("#last_name");
        let email_address_input=document.querySelector("#email_register");
        let password_input=document.querySelector("#password_input");
        let re_password_input=document.querySelector("#re_password_input");
        ProveraRegexom(regexName,first_name_input);
        ProveraRegexom(regexName,last_name_input);
        ProveraRegexom(regexEmail,email_address_input);
        ProveraPassworda(regexPassword,password_input,re_password_input);

        if(brGresaka==0){
           let objekat={
               first_name:first_name_input.value,
               last_name:last_name_input.value,
               email:email_address_input.value,
               password:password_input.value,
               btnKlik:true
           }
           ajaxCallBack("models/registration.php",objekat,function (rezultat){
               let ajax_rezultat=JSON.parse(rezultat);
               if(ajax_rezultat.code==201){
                   $(".response-text").html(`<p class="form-message alert alert-success mt-3">You have successfull registred</p>`);
                   document.querySelector("#formaRegistracija").reset();
                   window.location.href=""
               }
               else if(ajax_rezultat.code==422){
                   $(".response-text").html(`<p class="form-message alert alert-danger mt-3">You type something incorrect. Check your data</p>`);
               }
               else if(ajax_rezultat.code==409){
                   $(".response-text").html(`<p class="form-message alert alert-danger mt-3">You have already registred</p>`);
               }
           })
        }

    }

    function ProveraPassworda(regex,password,re_password){
        if(!regex.test(password.value)){
            password.classList.add("dj-t-border-red");
            brGresaka++;
        }
        else{
            password.classList.remove("dj-t-border-red");
        }
        if(password.value!=re_password.value){
            brGresaka++;
            re_password.nextElementSibling.classList.remove("dj-t-none");
            re_password.nextElementSibling.classList.add("dj-t-color-red");
        }
        else{
            re_password.nextElementSibling.classList.add("dj-t-none");
            re_password.nextElementSibling.classList.remove("dj-t-color-red");

        }
    }
}
function ProveraPodatakaLogin(){
    brGresaka=0;
    let email_input=document.querySelector("#email_login");
    let passw_input=document.querySelector("#password_login");
    ProveraRegexom(regexEmail,email_input);
    ProveraRegexom(regexPassword,passw_input)
    if(brGresaka==0){
        console.log("PROSAO");
        return true;
    }
    else{
        console.log(brGresaka);
        console.log("NIJE");
        return false;
    }

}
let dugme_contact=document.querySelector("#contact_btn");
if(dugme_contact!=null){
    dugme_contact.addEventListener("click",DohvatanjeFormeKontakta);
    function DohvatanjeFormeKontakta() {
        brGresaka = 0;
        let name = document.querySelector("#full_name");
        let subject = document.querySelector("#subject");
        let email = document.querySelector("#email_contact");
        let message = document.querySelector("#message");
        ProveraRegexom(regexFullName, name);
        ProveraRegexom(regexEmail, email);
        ValidateTextArea(message)
        function ValidateTextArea(textarea){
            if(textarea.value==""){
                brGresaka++
                textarea.nextElementSibling.classList.remove("dj-t-none");
                textarea.nextElementSibling.classList.add("dj-t-color-red");
                textarea.classList.add("dj-t-border-red");
            }
            else{
                textarea.nextElementSibling.classList.add("dj-t-none");
                textarea.nextElementSibling.classList.remove("dj-t-color-red");
                textarea.classList.remove("dj-t-border-red");
            }
        }
        if(brGresaka==0){
            let objekat={
                name:name.value,
                subject:subject.value,
                email:email.value,
                message:message.value,
                btnKlik:true
            }
            console.log(objekat);
            ajaxCallBack("models/contact_form.php",objekat,function (rezultat){
                console.log(rezultat);
                let ajax_response=JSON.parse(rezultat);
                let div_za_ispis=document.querySelector(".obavestenje");
                if(ajax_response.code=="201"){
                    div_za_ispis.innerHTML="<p class='alert alert-success text-center'>You have successfull sent your contact message</p>";
                    document.querySelector(".form-message").reset();
                }
            })
        }

    }

}
if(document.location.pathname.includes("views/pages/adminPanel/indexAdmin.php")){
   let inserts_button=document.querySelectorAll(".insert");
   console.log(inserts_button);
   if(inserts_button!=null){
       for(element of inserts_button){
           element.addEventListener("click",function (){

            document.querySelector("#dj-t-2").style.display="block";
            document.querySelector("#Odbij3").addEventListener("click",function (){
                document.querySelector("#dj-t-2").style.display="none";
            })
               document.querySelector("#Prihvati3").addEventListener("click",function (){
                   brGresaka=0;
                   let tabela=document.querySelector("#Prihvati3").getAttribute("data-table");
                   const podaci_za_slanje=new FormData();
                   var regexProductPicture=/.*\.(jpg|png|jpeg)$/;
                   podaci_za_slanje.append("tabela",tabela);
                   podaci_za_slanje.append("btnKlik",true);
                   console.log(podaci_za_slanje);
                   if(tabela=="products"){
                       let product_name=document.querySelector("#product_name");
                       let slika=document.querySelector("#src_file");
                       console.log(slika.files[0]);
                       let product_text=document.querySelector("#product_text");
                       let gender_ddl=document.querySelector("#gender");
                       let brand_ddl=document.querySelector("#brand");
                        ProveraDaliJePrazanString(product_name,"You have to fill in this field");
                        ProveraTextArea(product_text,"Your text must be longer than 3 characters","You have to fill in this field");
                        ProveraRegexom(regexProductPicture,slika);
                        ProveraDdlListe(gender_ddl,"You have to choose gender");
                        ProveraDdlListe(brand_ddl,"You have to choose brand");
                        if(brGresaka==0){
                            podaci_za_slanje.append("product_name",product_name.value);
                            podaci_za_slanje.append("product_picture",slika.files[0]);
                            podaci_za_slanje.append("product_text",product_text.value);
                            podaci_za_slanje.append("product_gender",gender_ddl.value);
                            podaci_za_slanje.append("product_brand",brand_ddl.value);
                        }
                   }
                   if(tabela=="product_price"){
                       let product_price_input=document.querySelector("#product_price");
                       let product_ddl=document.querySelector("#products");
                       let datum_od_input=document.querySelector("#date_of");
                       let datum_do_input=document.querySelector("#date_to");
                       let regex_price=/^[1-9]\d*$/;
                       ProveraDaliJePrazanString(product_price_input,"You have to fill in this field");
                       ProveraDdlListe(product_ddl,"You have to choose product");
                       ProveraDaliJePrazanString(datum_od_input,"You have to choose dateOf");
                       if(datum_do_input.value!=""){
                           ProveraDatuma(datum_od_input,datum_do_input,"the to date must not be greater than the to date");
                       }

                       if(brGresaka==0){
                           podaci_za_slanje.append("product_price",product_price_input.value);
                           podaci_za_slanje.append("productId",product_ddl.value);
                           podaci_za_slanje.append("datumOd",datum_od_input.value);
                       }

                   }
                   if(tabela=="users"){
                       let first_name_input=document.querySelector("#first_name");
                       let last_name_input=document.querySelector("#last_name");
                       let email_input=document.querySelector("#email");
                       let password_input=document.querySelector("#password");
                       let picture=document.querySelector("#picture");
                       let role_ddl=document.querySelector("#role");
                       ProveraRegexom(regexName,first_name_input);
                       ProveraRegexom(regexName,last_name_input);
                       ProveraRegexom(regexEmail,email_input);
                       ProveraRegexom(regexPassword,password_input);
                       if(picture.value!=""){
                           ProveraRegexom(regexProductPicture,picture);
                           podaci_za_slanje.append("picture",picture.files[0]);
                       }

                       ProveraDdlListe(role_ddl,"You have to choose role");

                       if(brGresaka==0){
                           podaci_za_slanje.append("first_name",first_name_input.value);
                           podaci_za_slanje.append("last_name",last_name_input.value);
                           podaci_za_slanje.append("email",email_input.value);
                           podaci_za_slanje.append("password",password_input.value);
                           podaci_za_slanje.append("roleId",role_ddl.value);
                       }

                   }
                   if(tabela=="navigation"){
                       let page_input=document.querySelector("#page");
                       let text_input=document.querySelector("#nav_text");
                       ProveraDaliJePrazanString(page_input,"You have to fill in this field");
                       ProveraDaliJePrazanString(text_input,"You have to fill in this field");
                       if(brGresaka==0){
                           podaci_za_slanje.append("page",page_input.value);
                           podaci_za_slanje.append("text",text_input.value);
                       }
                   }
                   if(tabela=="messages"){
                       let username_input=document.querySelector("#username");
                       let email_input=document.querySelector("#message_email");
                       let user_subject=document.querySelector("#user_subject");
                       let message_text=document.querySelector("#message_text");
                       ProveraRegexom(regexName,username_input);
                       ProveraRegexom(regexEmail,email_input);
                       ProveraDaliJePrazanString(user_subject,"You have to fill in this field");
                       ProveraTextArea(message_text,"Your text must be longer than 3 characters","You have to fill in this field");
                       if(brGresaka==0){
                           podaci_za_slanje.append("username",username_input.value);
                           podaci_za_slanje.append("email",email_input.value);
                           podaci_za_slanje.append("user_subject",user_subject.value);
                           podaci_za_slanje.append("message_text",message_text.value);

                       }
                   }
                   if(tabela=="role"){
                       RoleGenderColor("role");
                   }
                   if(tabela=="gender"){
                       RoleGenderColor("gender");
                   }
                   if(tabela=="color"){
                       RoleGenderColor("color");
                   }
                   if(tabela=="brand"){
                       let brand_name_input=document.querySelector("#_name");
                       let brand_description=document.querySelector("#deskripcija");
                       ProveraDaliJePrazanString(brand_name_input,"You have to fill in this field");
                       ProveraTextArea(brand_description,"Your text must be longer than 3 characters","You have to fill in this field");
                       if(brGresaka==0){
                           podaci_za_slanje.append("brand_name",brand_name_input.value);
                           podaci_za_slanje.append("brand_description",brand_description.value);
                       }

                   }
                   if(tabela=="specifications"){
                        RoleGenderColor("name_color");
                   }
                   if(tabela=="product_specification"){
                      let ddl_product=document.querySelector("#product");
                      let ddl_specification=document.querySelector("#specification");
                      let value_input=document.querySelector("#spec_value");
                      ProveraDaliJePrazanString(value_input,"You have to fill in this field");
                      if(brGresaka==0){
                          podaci_za_slanje.append("product_id",ddl_product.value);
                          podaci_za_slanje.append("specification_id",ddl_specification.value);
                          podaci_za_slanje.append("spec_value",value_input.value);
                      }
                   }
                   console.log(brGresaka);
                   console.log(podaci_za_slanje);
                    ajaxCallBack2("../../../models/insertAdmin.php",podaci_za_slanje,function(rezultat){
                        let ajax_response=JSON.parse(rezultat);
                        console.log(ajax_response);
                        if(ajax_response.code==201){
                            location.reload();
                        }
                    })
                   function RoleGenderColor(input){
                        input=document.querySelector("#_name_color");
                       ProveraDaliJePrazanString(input,"You have to fill in this field role");
                       if(brGresaka==0){
                           podaci_za_slanje.append("input",input.value);
                       }
                   }
                   function ProveraDaliJePrazanString(input,poruka){
                       if(input.value==""){
                           input.nextElementSibling.classList.remove("dj-t-none");
                           input.classList.add("dj-t-border-red");
                           input.nextElementSibling.classList.add("dj-t-color-red");
                           input.nextElementSibling.innerHTML=poruka;
                           brGresaka++;
                       }
                       else{
                           input.nextElementSibling.classList.add("dj-t-none");
                           input.classList.remove("dj-t-border-red");
                           input.nextElementSibling.classList.remove("dj-t-color-red");
                       }
                   }
                   function ProveraTextArea(input,poruka,poruka2){
                       if(input.value!=""){
                           if(input.value.length>3){
                               input.nextElementSibling.classList.add("dj-t-none");
                               input.classList.remove("dj-t-border-red");
                               input.nextElementSibling.classList.remove("dj-t-color-red");
                           }
                           else{

                               input.nextElementSibling.classList.remove("dj-t-none");
                               input.classList.add("dj-t-border-red");
                               input.nextElementSibling.classList.add("dj-t-color-red");
                               input.nextElementSibling.innerHTML=poruka;
                               brGresaka++;
                           }
                       }
                       else{

                           input.nextElementSibling.classList.remove("dj-t-none");
                           input.nextElementSibling.classList.add("dj-t-color-red");
                           input.classList.add("dj-t-border-red");
                           input.nextElementSibling.innerHTML=poruka2;
                           brGresaka++;
                       }
                   }
                   function ProveraDdlListe(ddlList,poruka){
                       if(ddlList.value=="0"){
                           ddlList.nextElementSibling.classList.remove("dj-t-none");
                           ddlList.classList.add("dj-t-border-red");
                           ddlList.nextElementSibling.classList.add("dj-t-color-red");
                           ddlList.nextElementSibling.innerHTML=poruka
                           brGresaka++;
                       }
                       else{
                           ddlList.nextElementSibling.classList.add("dj-t-none");
                           ddlList.classList.remove("dj-t-border-red");
                           ddlList.nextElementSibling.classList.add("dj-t-color-red");
                           ddlList.nextElementSibling.innerHTML="";
                       }
                   }
                   function ProveraDatuma(datumOd,datumDo,poruka){
                       if(datumDo.value<datumOd.value){
                           datumDo.nextElementSibling.classList.remove("dj-t-none");
                           datumDo.classList.add("dj-t-border-red");
                           datumDo.nextElementSibling.classList.add("dj-t-color-red");
                           datumDo.nextElementSibling.innerHTML=poruka;
                           brGresaka++;
                       }
                       else{
                           datumDo.nextElementSibling.classList.add("dj-t-none");
                           datumDo.classList.remove("dj-t-border-red");
                           datumDo.nextElementSibling.classList.remove("dj-t-color-red");
                           datumDo.nextElementSibling.innerHTML="";
                           podaci_za_slanje.append("datumDo",datumDo.value);
                       }
                   }

               })
           })
       }
   }
    let delete_buttons=document.querySelectorAll(".delete");
    for(let button of delete_buttons){
        button.addEventListener("click",function (){
            let id=$(this).data('id');
            let table=$(this).data('table');
            document.querySelector("#myModal").classList.add("d-block")
            document.querySelector("#Odbija").addEventListener("click",function (){document.querySelector("#myModal").classList.remove("d-block")})
            document.querySelector("#Prihvata").addEventListener("click",function (){
                let objekat={"id":id,"table":table,"btnKlik":true};
                ajaxCallBack("../../../models/deleteAdmin.php",objekat,function (rezultat){
                    console.log(rezultat);
                    let ajaxReponse=JSON.parse(rezultat);
                    if(ajaxReponse.code=="201"){
                        window.location.reload();
                    }
                })
            })
        });
    }
    let update_button=document.querySelectorAll(".updates");
    if(update_button!=null){
        for(let element of update_button){
            element.addEventListener("click",function(){
                var id=element.getAttribute("data-id");
                var table=element.getAttribute("data-table");
                const podaciZaSlanje=new FormData();
                let html=""
                let div_za_ispis=document.querySelector("#dj-t-2 .modal-body");
                console.log(div_za_ispis);
                document.querySelector("#dj-t-2").classList.add("d-block");
                document.querySelector("#Odbij3").addEventListener("click",function (){
                    document.querySelector("#dj-t-2").classList.remove("d-block");
                })
                div_za_ispis.innerHTML="";
                let objekat={};
                objekat.table=table;
                objekat.id=id;
                ajaxCallBack("../../../models/getColumnForEdit.php",objekat,function (rezultat){
                    console.log(rezultat);
                    let ajax_response=JSON.parse(rezultat)
                   popuniModal(ajax_response);
                    function popuniModal(data) {
                        let div_za_ispis=document.querySelector("#dj-t-2 .modal-body");
                        var html=""
                     console.log(data);
                     for(let element in data){
                         if(element=="password" || element=="banned" || element=="id" || element=="picture" || element=="src"){
                             continue;
                         }
                       else if(element.includes("_id")){
                           console.log()
                             var kurcina="";
                             console.log(element);
                             console.log(data[element]);
                             let strani_kljuc=element;
                             let objekat={};
                             objekat.kljuc=strani_kljuc;
                             ajaxCallBack("../../../models/getAllForForeignKey.php",objekat,function (rezultat){
                                 let ajax_response=JSON.parse(rezultat)
                                 splitovano=element.split("_");
                                 html+=`<div class="form-group">
                                        <label for="element">${splitovano[0]} name</label>
                                       <select id="${element}" class="form-control slanje">`
                                 for(let j of ajax_response){
                                     html+=`<option ${j.id==data[element]?"selected":""} value="${j.id}">${j.name}</option>`
                                 }
                                 html+=`</select>
                                </div>`;
                                 console.log();
                                 div_za_ispis.innerHTML=html;
                             })

                         }
                         else if(element=="email"){
                             html+=`<div class="form-group">
                                <label for="${element}">${element}</label>
                                <input type='email' name='email' id='email' value='${data[element]}' class="form-control slanje"/>
                                </div>`;
                         }
                         else if(element=="message_text" || element=="description"){
                             html+=`<div class="form-group">
                                <label for="${element}">${element}</label>
                                <textarea name="textarea" id="${element}" cols="30" rows="5" class="form-control slanje">${data[element]}</textarea>
                                </div>`;
                         }
                         else if(element=="posting_date"){
                             console.log(data[element]);
                             let x=data[element].split(" ");
                             console.log(x);
                             html+=`<div class="form-group">
                                <label for="${element}">${element}</label>
                                <input type='date' name='email' id='email' value='${x[0]}' class="form-control slanje"/>
                                </div>`;
                         }
                         else if(element=="dateOf" || element=="dateTo"){
                             html+=`<div class="form-group">
                                <label for="${element}">${element}</label>
                                <input type='date' name='email' id='email' value='${data[element]}' class="form-control slanje"/>
                                </div>`;
                         }
                         else{
                             html+=`
                             <div class="form-group">
                             <label for="${element}">${element}</label>
                             <input type='text' name='text' id='${element}' value=${data[element]} class="form-control slanje"/>
                             </div>`
                         }
                     }
                     div_za_ispis.innerHTML=html;

                    }
                })
                document.querySelector("#Prihvati3").addEventListener("click",function (){
                    let values=document.querySelectorAll(".slanje");
                    let tabela=table;
                    console.log(tabela);
                    let id_za_slanje=id;
                    console.log(id);
                    let niz_za_slanje=[];
                    for(let element of values){
                        if(element.value.includes("fakepath")){
                            niz_za_slanje.push(element.files[0]);
                        }
                        else{
                            niz_za_slanje.push(element.value);
                        }

                    }
                    let podaciZaSlanje=new FormData();
                    podaciZaSlanje.append("tabela",tabela);
                    podaciZaSlanje.append("niz",niz_za_slanje);
                    podaciZaSlanje.append("btnKlik",true);
                    podaciZaSlanje.append("id",id);
                    console.log(niz_za_slanje);
                    console.log(podaciZaSlanje);
                    ajaxCallBack2("../../../models/adminEdit.php",podaciZaSlanje,function (rezultat){
                        let ajax_response=JSON.parse(rezultat);
                        if(ajax_response.poruka=="Izvrseno"){
                            window.location.reload();
                        }
                    })
                })
        })
        }
    }
    let banned_button=document.querySelector("#laki_kitica");
    if(banned_button!=null){
        banned_button.addEventListener("click",function (){
            document.querySelector("#dj-t-8").style.display="block";
            document.querySelector("#Odbij5").addEventListener("click",function (){
                document.querySelector("#dj-t-8").style.display="none";
            })
            let unban_buttos=document.querySelectorAll(".unban_buttons");
            console.log(unban_buttos);
            for(let button of unban_buttos){
                button.addEventListener("click",function (){
                    let id=$(this).data('id');
                    console.log(id);
                    let objekat={"id_user":id,"btnKlik":true}
                    ajaxCallBack("../../../models/unbanUserAdmin.php",objekat,function (rezultat){
                        let ajax_response=JSON.parse(rezultat);
                        if(ajax_response.code=="201"){
                            window.location.reload();
                        }
                    })
                })
            }
        })
    }

}
$(document).on("click","#gender input",FiltriranjeSortiranje);
$(document).on("click","#brand input",FiltriranjeSortiranje);
$(document).on("click","#color ul li .dugmici",FiltriranjeSortiranje);
$(document).on("click","#discount input",FiltriranjeSortiranje);
$(document).on("change","#ddl_sorting",FiltriranjeSortiranje);
$(document).on("click",".paginacija",function (){
    $(".paginacija").each(function (e){
        $(this).parent().removeClass("active");
    })
    $(this).parent().addClass("active");
    FiltriranjeSortiranje();
});
function FiltriranjeSortiranje(){
    var objekat={};
    let gender_id=[];
    let brand_id=[]
    objekat.btnKlik=true;
 brand_id=DohvatanjeNiza("brand input");
if(brand_id.length!=0)objekat.brandId=brand_id;
 gender_id=DohvatanjeNiza("gender input");
console.log(gender_id);
if(gender_id.length!=0)objekat.genderId=gender_id;
let color_id=DohvatanjeButtona.call(this);
if(color_id!=undefined)objekat.colorId=color_id;
let discount=DohvatanjeNiza("discount input","dak");
if(discount!=''){
    objekat.discount=discount;
}
let ddl_value=DohvatanjeDdlListe("#ddl_sorting");
if(ddl_value!=''){
    objekat.sort=ddl_value;
}
if($(".pagination .active")){
    objekat.page=$(".pagination .active a").text();
}

console.log(objekat);
ajaxCallBack("models/filter_sort.php",objekat,function (rezultat){
    let ajaxResponse=JSON.parse(rezultat);
    console.log(ajaxResponse[0].proizvodi);
    LoadProducts(ajaxResponse[0].proizvodi);
    if(ajaxResponse[0].proizvodi.length>0){
        makePagination(ajaxResponse[0].brojProizvoda,$(".pagination .active a").text());
    }

})
}
function DohvatanjeNiza(x,tip='chb'){
    if(tip=='chb'){
        let pomocni_niz=[];
        $('#'+x+':checked').each(function(){
            pomocni_niz.push($(this) .val());
        })
        return pomocni_niz;
    }
    else{
        let value="";
        $('#'+x+':checked').each(function(){
           value=($(this) .val());
        })
        return value;
    }

}
function DohvatanjeButtona() {
    var id = $(this).data('id');
    return id;
}
function DohvatanjeDdlListe(tip){
    let ddl_list_value=document.querySelector(tip).value;
    return ddl_list_value;

}
function LoadProducts(niz){
    console.log(niz);
    let x="";
    let div_za_ispis=document.querySelector(".product-one");
    div_za_ispis.innerHTML="";
    if(niz.length==0){
        x="<h1>No products right now</h1>"
    }
    else{
        var brojac=1;
        for(let element of niz){
            x+=`
            <div class="col-md-4 product-left p-left ${brojac>3?"dj-t-margin-top-proizvodi":""}">
                <div class="product-main simpleCart_shelfItem">
                    <a href="index.php?page=single&id=${element.id}" class="mask">
                    <img class="img-responsive zoom-img" src="assets/images/img-resize/${element.src}" alt="" /></a>
                <div class="product-bottom">
                    <h3>${element.name}</h3>
                    <p>Explore now</p>
                    <h4>                           
                     <del class="dj-t-dell-product">${element.old_price!=null?"$"+element.old_price:""}</del>
                      <?php
                                         if(isset($_SESSION["korisnik"])):
                                        ?>
                      <button class="item_add" href="#" data-id="${element.id}"><i></i></button>
                      <?php endif; ?>
                     <span class=" item_price">$${element.dateTo==null?Math.round(element.price):""}</span>
                     </h4>
                </div>`;
            if(element.old_price){
                x+=`<div class="srch srch1">
                        <span>${IzracunajProcenat(element.old_price,element.price)}%</span>
                    </div>`
            }
            x+= "</div></div>";
            brojac++;
        }
        x+=`<div class="clearfix"></div>`
    }

    function IzracunajProcenat(stara_cena,trenutna_cena){
        let izlaz=100-(trenutna_cena*100)/stara_cena;
        return Math.round(izlaz);
    }
    div_za_ispis.innerHTML=x;
}
function makePagination(duzina,aktivno){
    console.log(duzina);
    console.log(aktivno)
    aktivno=parseInt(aktivno);
    let html = "";
    //console.log(activePage);
    let productsHtml = document.querySelector('.product-one').innerHTML;
    let numOfPages = Math.ceil(duzina / 9);
    html = `<div class="dj-t-flex dj-t-center">
                            <nav aria-label="Page navigation example mx-auto">
                                <ul class="pagination">`;
    for (let i = 1; i <= 1; i++){
        if(aktivno == 1){
            html += `<li class="page-item active"><a class="page-link paginacija">${i}</a></li>`;
            continue;
        }
        else{
            html +=  `<li class="page-item"><a class="page-link paginacija">${i}</a></li>`;
        }
    }
    for (let i = 2; i <= numOfPages; i++)
    {
        if(i == aktivno){
            html += `<li class="page-item active"><a class="page-link paginacija">${i}</a></li>`;
            continue;
        }
        html +=  `<li class="page-item"><a class="page-link paginacija">${i}</a></li>`;
    }
    html += "</ul></nav></div>";
    productsHtml += html;
    console.log(html);
    $('.product-one').html(productsHtml);

}
let rolex_sat=document.querySelector("#rolexSat");
if(rolex_sat!=null){
    rolex_sat.addEventListener("click",function (e){
        e.preventDefault();
        localStorage.setItem("brandId",1);
        window.location.href="index.php?page=products";
    });
}
let tissot_sat=document.querySelector("#tissotSat");
if(tissot_sat!=null){
    tissot_sat.addEventListener("click",function (e){
        e.preventDefault();
        localStorage.setItem("brandId",3);
        window.location.href="index.php?page=products";
    })
}
let casio_sat=document.querySelector("#casioSat");
if(casio_sat!=null){
    casio_sat.addEventListener("click",function (e){
        e.preventDefault();
        localStorage.setItem("brandId",5);
        window.location.href="index.php?page=products";
    })
}
window.onload=function () {
    let brand_id = localStorage.getItem("brandId");
    if(brand_id!=null){
        let brands = document.querySelectorAll("#brand input");
        console.log(brand_id);
        for (let brand of brands) {
            if (brand.value == brand_id) {
                brand.checked = true;
                localStorage.removeItem("brandId");
            }
        }
        let objekat = {"brandId": brand_id,"btnKlik":true}
        ajaxCallBack("models/filter_sort.php", objekat, function (rezultat) {
            let ajaxResponse = JSON.parse(rezultat);
            console.log(ajaxResponse);
            LoadProducts(ajaxResponse[0].proizvodi);
        });
    }

}
$(document).on("click",".item_add",AddToCart);
// let add_to_cart_buttons=document.querySelectorAll(".item_add");
// if(add_to_cart_buttons!=null){
//     for(let element of add_to_cart_buttons) {
//         element.addEventListener("click",AddToCart);
//
//     }
function AddToCart(){
    let id_value=$(this).data('id');
    let carts_length=JSON.parse(localStorage.getItem('carts_array'));
    var cart_array=[];
    if(carts_length){
        if(CheckArraySameProducts()){
            let niz=JSON.parse(localStorage.getItem("carts_array"));
            for(var element in niz){
                if(niz[element].id==id_value){
                    niz[element].quantity++;
                    break;
                }
            }
            localStorage.setItem("carts_array",JSON.stringify(niz));
            AddCartModal("You have successfull update quantity for product");
            NumberOfProductsInCart();
        }
        else{
            let niz=JSON.parse(localStorage.getItem("carts_array"));
            niz.push({
                id:id_value,
                quantity:1,
            });
            localStorage.setItem("carts_array",JSON.stringify(niz));
            AddCartModal("You have successfull added the product to the cart");
            NumberOfProductsInCart();



        }
    }
    else{
        cart_array[0]={
            id:id_value,
            quantity:1
        }
        localStorage.setItem("carts_array",JSON.stringify(cart_array));
        AddCartModal("You have successfull added the first product to the cart");
        NumberOfProductsInCart();
    }
    CheckElement();

    function CheckArraySameProducts(){
        let niz=JSON.parse(localStorage.getItem("carts_array"));
        for(let i=0;i<niz.length;i++){
            if(niz[i].id==id_value) return 1;
        }
        return 0;
    }
}

    function CheckElement(){
        let niz=JSON.parse(localStorage.getItem("carts_array"));
        console.log(niz);
        if(niz==null || niz.length==0){
            let x_niz=[];
            LoadQuantityInProducts(x_niz);
        }
        else{
            let objekat={"cart_array":niz};
            ajaxCallBack("models/cart_items.php",objekat,function (rezultat){
                console.log(rezultat);
                let ajax=rezultat.trim();
                let niz=JSON.parse(ajax);
                LoadQuantityInProducts(niz)
            })
        }


    }
    function  LoadQuantityInProducts(niz){
        let cart_array=JSON.parse(localStorage.getItem("carts_array"));
        if(niz.length==0){
            localStorage.setItem("niz_za_ispis",JSON.stringify(niz));
            Proba123();
        }
        else{
            console.log(niz);
            console.log(cart_array);
            for(let element of niz){
                for(let element2 of cart_array){
                    if(element.id==element2.id){
                        element.quantity=element2.quantity;
                    }
                }
            }
            console.log(niz);
            localStorage.setItem("niz_za_ispis",JSON.stringify(niz));
            Proba123();
        }



    }
    function NumberOfProductsInCart(){
        let broj;
        let cart_array=JSON.parse(localStorage.getItem("carts_array"));
        if(cart_array==null){
            broj=0;
        }
        else{
            broj=cart_array.length;
        }
        let simpleCart_total=document.querySelector(".simpleCart_total");
        if(simpleCart_total!=null){
            simpleCart_total.textContent=broj;
        }

    }
    function  AddCartModal(poruka) {
        let small_modal = document.querySelector("#myModal");
        console.log(small_modal);
        let small_modal_value = document.querySelector("#myModal p");
        small_modal_value.textContent = "";
        small_modal_value.textContent = poruka;
        small_modal.classList.add("dj-t-block");
        setTimeout(() => {
            small_modal.classList.remove("dj-t-block");

        }, 1100);




}
let div_za_ispis=document.querySelector(".djordje");
console.log(div_za_ispis);
if(div_za_ispis!=null){
    Proba123();
}
function Proba123(){
    let total=0;
    let div_za_ispis_totala=document.querySelector(".text-right span");
    let niz_za_ispis=JSON.parse(localStorage.getItem("niz_za_ispis"));
    if(niz_za_ispis==null || niz_za_ispis.length==0){
        div_za_ispis.innerHTML="<h1>There are no products right now</h1>";
    }
    else{

        let x="";
        for(let element of niz_za_ispis){
            x+=` <ul class="cart-header">
                        <button class="close1 btn-x" data-id="${element.id}"></button>
                        <li class="ring-in"><a href="index.php?page=single&id=${element.id}" ><img src="assets/images/img-resize/${element.src}" class="img-responsive" alt=""></a>
                        </li>
                        <li><span class="name">${element.name}</span></li>
                        <li><span class="cost">$${PriceForProduct(element.price,element.quantity)}</span></li>
                        <li>
                            <input type="number" class="dj-t-input-number form-control" min="1" data-id="${element.id}" value="${element.quantity}" onclick="ChangeQuantity(this)"/>
                        </li>
                        <div class="clearfix"> </div>
                    </ul>`;
            total+=PriceForProduct(element.price,element.quantity);
        }
        div_za_ispis.innerHTML=x;
        console.log(total);

        function  PriceForProduct(price,quantity){
            price=parseInt(price);
            quantity=parseInt(quantity);
            return price*quantity;
        }
        function ChangeQuantity(element){
            let attr=element.getAttribute("data-id");
            let element_value=element.value;
            element_value=parseInt(element_value);
            let cart_array=JSON.parse(localStorage.getItem("carts_array"));
            for(var x of cart_array){
                if(x.id==attr){
                    x.quantity=element_value
                }
            }
            if(element_value<1){

                document.querySelector(".quantity").innerHTML=element_value=1;
            }
            localStorage.setItem("carts_array",JSON.stringify(cart_array));
            CheckElement();
            //setTimeout(function(){window.location.reload()},100);
        }
    }
    div_za_ispis_totala.textContent=total+"$";
}
function ChangeQuantity(element){
    let attr=element.getAttribute("data-id");
    let element_value=element.value;
    element_value=parseInt(element_value);
    let cart_array=JSON.parse(localStorage.getItem("carts_array"));
    for(var x of cart_array){
        if(x.id==attr){
            x.quantity=element_value
        }
    }
    if(element_value<1){

        document.querySelector(".quantity").innerHTML=element_value=1;
    }
    localStorage.setItem("carts_array",JSON.stringify(cart_array));
    CheckElement();
    //setTimeout(function(){window.location.reload()},100);
}
let button_cart_x=document.querySelectorAll(".btn-x");
console.log(button_cart_x)
if(button_cart_x!=null){
    for (let element of button_cart_x){
        element.addEventListener("click",RemoveCartElement);
        function RemoveCartElement(){
            let id=$(this).data('id');
            console.log(id);
            let cart_array=JSON.parse(localStorage.getItem("carts_array"));
            console.log(cart_array);
            let pomocni_niz=[];
            for(let element of cart_array){
                if(element.id==id){
                    continue;
                }
                else{
                    pomocni_niz.push(element);
                }
            }
            console.log(pomocni_niz);
            localStorage.setItem("carts_array",JSON.stringify(pomocni_niz));
            CheckElement();
            NumberOfProductsInCart();
            window.location.reload();

        }
    }
}
let delete_all=document.querySelector("#delete_all");
if(delete_all!=null){
    delete_all.addEventListener("click",function (){
        localStorage.removeItem("carts_array");
        localStorage.removeItem("niz_za_ispis");
        CheckElement();
    })
}
NumberOfProductsInCart();
let checkout_btn=document.querySelector("#checkout");
if(checkout_btn!=null){
checkout_btn.addEventListener("click",function (){
        let ispis=JSON.parse(localStorage.getItem("niz_za_ispis"));
        if(ispis!=null){
            let objekat={"cart":ispis};
            ajaxCallBack("models/checkoutCart.php",objekat,function (rezultat){
                console.log(rezultat);
                let poruka_ispis=document.querySelector("#msg");
                let ajax_response=JSON.parse(rezultat);
                if(ajax_response.code=="201"){
                    poruka_ispis.innerHTML="<p class='alert alert-success'>You have successfull checkout your shopping cart</p>";
                    localStorage.removeItem("carts_array");
                    localStorage.removeItem("niz_za_ispis");
                    CheckElement();
                }
                else if(ajax_response.code=="423"){
                    poruka_ispis.innerHTML="<p class='alert alert-danger'>You cant checkout</p>";
                }
            })
        }
    })
}
let history_button=document.querySelector(".history-button");
console.log(history_button);
if(history_button!=null){
    history_button.addEventListener("click",function (e){
        e.preventDefault()
        document.querySelector("#dj-t-5").classList.add("dj-t-block");
        document.querySelector("#Odbij5").addEventListener("click",function (){
            document.querySelector("#dj-t-5").classList.remove("dj-t-block");
        })
    })
}
let edit_profile_btn=document.querySelector("#save");
if(edit_profile_btn!=null){
    edit_profile_btn.addEventListener("click",function (){
        brGresaka=0;
        let podaci=new FormData();
        let ime_input=document.querySelector("#ime");
        let prezime_input=document.querySelector("#prezime");
        let email_input=document.querySelector("#email");
        let picture_input=document.querySelector("#picture");
        let regexPicture=/.*\.(jpg|png|jpeg)$/;
        ProveraRegexom(regexName,ime_input);
        ProveraRegexom(regexName,prezime_input);
        ProveraRegexom(regexEmail,email_input);
        if(picture_input.value!=""){
            ProveraRegexom(regexPicture,picture_input);
            podaci.append("picture",picture_input.files[0]);
        }
        if(brGresaka==0){
            podaci.append("first_name",ime_input.value);
            podaci.append("last_name",prezime_input.value);
            podaci.append("email",email_input.value);
            podaci.append("btnKlik",true);
            ajaxCallBack2("models/userChangeProfil.php",podaci,function (rezultat){
               let ajax_response=JSON.parse(rezultat);
               if(ajax_response.code=="201"){
                   window.location.reload();
               }
               else{
                   alert("Greska");
               }
            })
        }
    })
}


