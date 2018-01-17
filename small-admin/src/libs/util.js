import moment from 'moment'

let util = {}

/**
 * 设置浏览器 title
 * @param title
 */
util.title = (title = 'admin') => {
  window.document.title = title
}

/**
 * 判断 IE 版本
 * @returns {*}
 * @constructor
 */
util.IEVersion = () => {
  const userAgent = navigator.userAgent // 取得浏览器的userAgent字符串
  const isIE = userAgent.indexOf('compatible') > -1 && userAgent.indexOf('MSIE') > -1 // 判断是否IE<11浏览器
  const isEdge = userAgent.indexOf('Edge') > -1 && !isIE // 判断是否IE的Edge浏览器
  const isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf('rv:11.0') > -1
  if (isIE) {
    const reIE = new RegExp('MSIE (\\d+\\.\\d+);')
    reIE.test(userAgent)
    const fIEVersion = parseFloat(RegExp['$1'])
    if (fIEVersion === 7) {
      return 7
    } else if (fIEVersion === 8) {
      return 8
    } else if (fIEVersion === 9) {
      return 9
    } else if (fIEVersion === 10) {
      return 10
    } else {
      return 6 // IE版本<=7
    }
  } else if (isEdge) {
    return 'edge'// edge
  } else if (isIE11) {
    return 11 // IE11
  } else {
    return -1 // 不是ie浏览器
  }
}

/**
 * 格式化一个本地时间／日期
 * @param timestamp
 * @param format
 * @returns {string}
 */
util.date = (timestamp = util.strtotime(), format = 'YYYY-MM-DD HH:mm:ss') => {
  return moment.unix(timestamp).format(format)
}

/**
 * 将任何字符串的日期时间描述解析为 Unix 时间戳
 * @param time
 * @returns {string}
 */
util.strtotime = (time = new Date()) => {
  return moment(time).format('X')
}

export default util
