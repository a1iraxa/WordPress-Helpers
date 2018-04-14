function newValues() {
  var serializedValues = jQuery("#frm input,#frm select,#frm textarea[name!=cs_export_theme_options]").serialize();
  return serializedValues;
}
var serializedReturn = newValues();
