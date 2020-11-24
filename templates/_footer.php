<footer>

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

    #clear_cache{
      display: block;
      width: 100%;
      text-align: center;
      padding: 10px;
    }
  </style>

</footer>

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

<?php if ($sf_user->isAdministrator()) { ?> 
 <a href="#" id="clear_cache">Clear cache</a>

<script>
 jQuery(function(){
  jQuery("#clear_cache").on("click", function (e) {
    e.preventDefault();
    jQuery(this).text("Clearing cache...");
    jQuery.ajax({
      url:"/plugins/arVinculumPlugin/modules/cc.php"
    }).done(function (data) {
      jQuery("#clear_cache").text("Clearing cache... done!");
    }).fail(function (error) {
      console.log(error);
    })
   });
 })
</script>

<?php } ?>

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