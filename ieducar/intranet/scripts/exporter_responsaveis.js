(function () {
  'use strict'

  const dataExportResponsaveis = (formId, resource) => {
    const form = document.getElementById(formId)
    const data = new FormData(form)
    const queryString = new URLSearchParams(data).toString()
    const url = `/exports/${resource}?${queryString}`

    window.location = url
  }

  window.dataExport = dataExportResponsaveis
  document.getElementById('export-btn-responsaveis').style.marginTop = 0;

})()
