import axios from 'axios';

/**
 * @returns {Promise<AxiosResponse<any>>}
 */
export function fetchCategories() {
    return axios.get('/api/categories');
}
