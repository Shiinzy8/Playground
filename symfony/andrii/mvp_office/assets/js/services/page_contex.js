/**
 * Returns the current category is that's set by the server.
 *
 * @returns (string|null)
 */
export function getCurrentCategoryId() {
    if (!window.currentCategoryId) {
        return '';
    }
    return window.currentCategoryId;
}
