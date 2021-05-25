/**
 * Formats a price by adding a dot and normalizing decimals
 *
 * @param price
 * @returns {string}
 */
export default (price) => (
    (price / 100).toLocaleString('en-US', { minimumIntegerDigits: 2 })
);
