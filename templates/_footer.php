<footer id="footer">
<!-- Illumini -->   
<?php if (QubitAcl::check('userInterface', 'translate')): ?>
    <?php echo get_component('sfTranslatePlugin', 'translate') ?>
  <?php endif; ?>

  <?php echo get_component_slot('footer') ?>

  <div id="print-date">
    <?php echo __('Printed: %d%', array('%d%' => date('Y-m-d'))) ?>
  </div>

  <style>
    .modal{
      position: fixed;
      top: 112px;
      right: 0px;
      border-radius: 5px;
      z-index: 1000;
      color: #ffffff;
      background-color: #f80;
      padding: 15px 20px;
      width: 105px;
      /* float: right; */
      margin: auto;
    }

    .modal-close{
      display: none;
    }
<!--
    #clear_cache{
      display: block;
      width: 100%;
      text-align: center;
      padding: 10px;
    }
-->
  </style>


 <section class="container">

 <div id="note">
      <div class="span12">
      		<p>&#9656; On the database rationale and practical information see pages <a href="/index.php/about" target="_self">About</a> and <a href="/index.php/information" target="_self">Information</a>.
        </p>
       </div>
  </div>
  
    <div class="span3">
        <ul>
            <span class="title"><h1>ADDRESS</h1></span>
                     <p>Faculdade de Ciências Sociais e Humanas
                        da Universidade Nova de Lisboa<br>
                        Colégio Almada Negreiros,<br>
                        Campus de Campolide<br>
                        1099-085 Lisboa<br>
                        Portugal</p>
                     <p>Email: <a href="mailto:vinculum@fcsh.unl.pt">vinculum@fcsh.unl.pt</a><br>
                        Phone: +351 918 832 042<br>
                        <a href="https://www.vinculum.fcsh.unl.pt">www.vinculum.fcsh.unl.pt</a>
                    </p>
         </ul>
     </div>

    <div class="span9">
        <ul>
            <span class="title"><h1>ACKNOWLEDGMENTS</h1></span>
                  <p>VINCULUM - Entailing Perpetuity: Family, Power, Identity. 
                     The Social Agency of a Corporate Body (Southern Europe, 14th-17th Centuries) 
                     project has received funding from the European Research Council (ERC) 
                     under the European Union’s Horizon 2020 research and innovation programme 
                     (<a href="https://cordis.europa.eu/project/id/819734">grant agreement No. 819734</a>)
                 </p>
            <p>
            <a href="https://erc.europa.eu"><img src="/plugins/arVPlugin/images/LOGO_ERC-FLAG_EU-Positivo.png" width="250" alt="177"></a>
            <a href="https://www.fcsh.unl.pt"><img src="/plugins/arVPlugin/images/LOGO_NOVA-FCSH.png" width="263" alt="177"></a>
            <a href="https://iem.fcsh.unl.pt"><img src="/plugins/arVPlugin/images/LOGO_IEM.png" width="126" alt="177"></a>
            </p>
        </ul>
    </div>
    
    </section>

  </footer>
  
<!-- Illumini -->
<?php $gaKey = sfConfig::get('app_google_analytics_api_key', '') ?>
<?php if (!empty($gaKey)): ?>
  <script>
    window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
    ga('create', '<?php echo $gaKey ?>', 'auto');
    <?php include_slot('google_analytics') ?>
    ga('send', 'pageview');
  </script>
  <script async src='https://www.google-analytics.com/analytics.js'></script>
<?php endif; ?>


<script>
  var defaultValues = {
    "actorAddRules": "INTERNATIONAL COUNCIL ON ARCHIVES – ISAAR(CPF): International Standard Archival Authority Records for Corporate Bodies, Persons and Families: prepared by The Committee on Descriptive Standards. Ottawa: ICA/CDS, 2004. ISBN: 2-9521932-2-3.",
    "archivalAddRules": "INTERNATIONAL COUNCIL ON ARCHIVES – ISDIAH: International Standard for Describing Institutions with Archival Holdings: First edition: Developed by the Committee on Best Practices and Standards, London, United Kingdom, 10-11 March 2008.",
    "descriptionRules": "INTERNATIONAL COUNCIL ON ARCHIVES – ISAD(G): General International Standard Archival Description: adopted by the Committee on Descriptive Standards, Stockolm, Sweden, 19-22 September 1999. 2nd ed. Ottawa: CIA/CDS, 2000. ISBN 0-9696035-5-X \nDIREÇÃO GERAL DE ARQUIVOS; PROGRAMA DE NORMALIZAÇÃO DA DESCRIÇÃO EM ARQUIVO; GRUPO DE TRABALHO DE NORMALIZAÇÃO DA DESCRIÇÃO EM ARQUIVO – Orientações para a descrição arquivística. 2.ª v. Lisboa: DGARQ, 2007, 325 p."
  }

  var modal = document.createElement('div')
  modal.innerHTML = 'Updating form...'
  modal.classList.add("modal")

  if(
    window.location.pathname === '/index.php/actor/add' ||
    window.location.pathname === '/index.php/repository/add'
    ) {
    document.body.appendChild(modal)
  }

  window.onload = function() {
    // DEFAULT TEXT IN CREATION FIELDS
    
    // add actor
    let form = document.querySelector("form[action='/index.php/actor/add']");
    
    if (form) {
      document.querySelector("label[for='maintainingRepository']").innerHTML = 'Entail/ Vínculo'

      form.querySelector("#rules").value = !form.querySelector("#rules").value ? defaultValues.actorAddRules : form.querySelector("#rules").value

      form.querySelector("#descriptionStatus").selectedIndex = 3
      form.querySelector("#descriptionDetail").selectedIndex = 2
      form.querySelector("#legalStatus").style.display = 'none'

      let select = document.createElement('select');
      select.id = 'legalStatusNew'

      let opt = new Option('', '', false, false);
      select.appendChild(opt);
      let option = new Option('Institutor', 'Institutor', false, false);
      select.appendChild(option);
      let option2 = new Option('Administrator', 'Administrator', false, false);
      select.appendChild(option2);

      form.querySelector("#legalStatus").parentNode.insertBefore(select, form.querySelector("#legalStatus").nextSibling)

      document.getElementById('legalStatusNew').onchange = () => {
          document.querySelector("#legalStatus").value = document.getElementById('legalStatusNew').value
      };

    }    

    // add archival institution
    form = document.querySelector("form[action='/index.php/repository/add']");
    
    if (form) {
      document.querySelector("#type ~ ul").innerHTML = '<li title="Remove item"><input name="type[]" type="hidden" value="/index.php/community"><span>Corporate Body</span></li>'
      document.querySelector("#type ~ ul").style.display = 'block'      

      form.querySelector("#descRules").value = !form.querySelector("#descRules").value ? defaultValues.archivalAddRules : form.querySelector("#descRules").value


      form.querySelector("#descStatus").selectedIndex = 3
      form.querySelector("#descDetail").selectedIndex = 2
    }    

    // add archival descriptions
    form = document.querySelector("form[action='/index.php/informationobject/add']");
    
    if (form) {
      form.querySelector("#levelOfDescription").selectedIndex = 4

      //document.querySelector("label[for='repository']").innerHTML = 'Entail/ Vínculo'

      document.querySelector("#language ~ ul").innerHTML = '<li title="Remove item"><input name="language[]" type="hidden" value="pt"><span>Portuguese</span></li>'
      document.querySelector("#language ~ ul").style.display = 'block'

      form.querySelector("#rules").value = !form.querySelector("#rules").value ? defaultValues.descriptionRules : form.querySelector("#rules").value

      form.querySelector("#descriptionStatus").selectedIndex = 3
      form.querySelector("#descriptionDetail").selectedIndex = 2
    }
    
    modal.classList.add("modal-close")

  };
</script>
