export default class Helper {
  static generateURLParams (url, parameter, value) {
    if (url.includes('?')) {
      url += `&${parameter}=${value}`
    } else {
      url += `?${parameter}=${value}`
    }

    return url
  }
}