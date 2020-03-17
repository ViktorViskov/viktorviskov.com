export function createTag(tagName, ...classNames) {
    let element = document.createElement(tagName);
    for (let className of classNames) {
        element.classList.add(className);
    }
    return element;
}
export function setAttributes(item, attribut, attributalue) {
}