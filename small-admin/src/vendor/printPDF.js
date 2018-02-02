import printJS from 'print-js'

export function printPdf(id) {
  printJS(id, 'html')
}
