import axios from 'axios'
import constants from '../helper/constants';

axios.defaults.baseURL = constants.SERVER_ROOT

export default axios