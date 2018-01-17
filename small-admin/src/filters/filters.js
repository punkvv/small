import Util from '@/libs/util'

/**
 * 格式化时间戳
 * @param timestamp
 * @param format
 */
export const date = (timestamp, format) => {
  return Util.date(timestamp, format)
}
