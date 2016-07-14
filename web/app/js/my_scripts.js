$("#ajouter-produit").click(function() { 
  var urlFormulaire = Routing.generate('formulaire_recherche_produit');
  $.ajax({
    type: "POST",
    url: urlFormulaire,
    dataType: 'html',
    cache: false,
    success: function(codeHTML, statut) {
      $("#ajouter-produit").before(codeHTML);
    }
  });
  return false;
});

$("#rechercher-recette").keyup(function() {
  searchText = $(this).val();
  var urlChercherRecette = Routing.generate('chercher_recette', {'slugUser': 'paul-mesnilgrente','caracteres': searchText});
  if (searchText.length >= 3) {
    $.ajax({
      type: "POST",
      url: urlChercherRecette,
      dataType: 'html',
      cache: false,
      success: function(codeHTML, statut) {
        $("#results").html(codeHTML);
      }
    });
    return false;
  } else {
    $("#results").html("");
  }
});
