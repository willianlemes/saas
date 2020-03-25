function clearFormCEP() {
  document.getElementById('cidade').value=("");
  document.getElementById('uf').value=("");
}

function loadingInputs() {
  document.getElementById('cidade').value="...";
  document.getElementById('uf').value="...";
}

function myCallback(response) {
  if (!("erro" in response)) {
     document.getElementById('cidade').value=(response.localidade);
     document.getElementById('uf').value=(response.uf);
     document.getElementById('ibge').value=(response.ibge);
  }else {
   clearFormCEP();
   alert("CEP não encontrado.");
  }
}

function searchCEP(valor) {

   //Nova variável "cep" somente com dígitos.
   var cep = valor.replace(/\D/g, '');

   //Verifica se campo cep possui valor informado.
   if (cep != "") {

       //Expressão regular para validar o CEP.
       var validacep = /^[0-9]{8}$/;

       //Valida o formato do CEP.
       if(validacep.test(cep)) {

           loadingInputs();

           //Cria um elemento javascript.
           var script = document.createElement('script');

           //Sincroniza com o callback.
           script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=myCallback';

           //Insere script no documento e carrega o conteúdo.
           document.body.appendChild(script);

       }
       else {
           clearFormCEP();
           alert("Formato de CEP inválido.");
       }
   }
   else {
       clearFormCEP();
   }
};
