import { scroll } from 'quasar'
const { getScrollTarget, setVerticalScrollPosition } = scroll

export default class Helper {
  static generateURLParams (url, parameter, value) {
    if (url.includes('?')) {
      url += `&${parameter}=${value}`
    } else {
      url += `?${parameter}=${value}`
    }

    return url
  }

  static scrollToElement (el, coffset = null) {
    const target = getScrollTarget(el)
    const offset = coffset === null ? el.offsetTop : coffset
    const duration = 500
    setVerticalScrollPosition(target, offset, duration)
  }
}