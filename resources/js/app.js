import './bootstrap'
import Dropzone from 'dropzone'

Dropzone.autoDiscover = false

if (document.getElementById('dropzone')) {
  const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false
  })

  dropzone.on('sending', (file, xhr, formData) => {
    // console.log('El archivo subido es:')
    // console.dir(file)
  })

  dropzone.on('success', (file, response) => {
    console.info('Imagen procesada correctamente:')
    console.log(response)
  })
  dropzone.on('error', (file, message) => {
    console.error('Error subiendo el archivo:')
    console.error(message)
  })

  dropzone.on('removedfile', (file) => {
    // console.log('Archivo eliminado:')
    // console.log(file)
  })
}
