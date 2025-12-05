$(document).ready(function () {
  if (window.faltaGestionar) {
    openventana(".ventana");

    $("body").css("overflow", "hidden");

    iniciarTaxonomia();

    $("#top").closest("tr").show();
    $("#tac").closest("tr").show();
  }

  var ide = window.idReporte;

  boton_toggle("boton_o", "mostrar");
  boton_toggle("boton_o2", "mostrar2");

  cargari_rep(ide);
  cargari_rep2(ide);
  cargarti_emp(ide);
  cargarti_pel(ide);
  cargar_rie(ide);

  cargar_coo("area1");
  cargar_coo("area_res");
  cargar_coo("area_res_asignar");

  var tabButton = document.getElementById("defaultOpen");
  if (tabButton) {
    tabButton.click();
  }
});

function iniciarTaxonomia() {
  GestionService.obtenerOperaciones().done(function (data) {
    var $sel = $("#top");
    $sel.empty().append('<option value="">-- ELEGIR OPERACIÓN --</option>');
    data.forEach(function (item) {
      $sel.append(
        '<option value="' + item.id + '">' + item.nombre + "</option>"
      );
    });
  });

  $("#top").change(function () {
    var idOp = $(this).val();
    $("#tac").empty().append('<option value="">Cargando...</option>');
    $("#ide_gen")
      .empty()
      .append('<option value="">-- Esperando Actividad --</option>');

    if (idOp) {
      GestionService.obtenerActividades(idOp).done(function (data) {
        var $sel = $("#tac");
        $sel.empty().append('<option value="">-- ELEGIR ACTIVIDAD --</option>');
        data.forEach(function (item) {
          $sel.append(
            '<option value="' + item.id + '">' + item.nombre + "</option>"
          );
        });
      });
    }
  });

  $("#tac").change(function () {
    var idAct = $(this).val();

    if (idAct) {
      var $sel = $("#ide_gen");

      if ($sel.is("select")) {
        $sel.empty().append('<option value="">Cargando...</option>');
        GestionService.obtenerGenericos(idAct).done(function (data) {
          $sel.empty().append('<option value="">-- ELEGIR PELIGRO --</option>');
          data.forEach(function (item) {
            $sel.append(
              '<option value="' + item.nombre + '">' + item.nombre + "</option>"
            );
          });
        });
      }
    }
  });
}
