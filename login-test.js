import http from 'k6/http';
import { check } from 'k6';

export const options = {
    scenarios: {
        login_test: {
            executor: 'per-vu-iterations',
            vus: 10,
            iterations: 1,
            maxDuration: '1m',
        },
    },
};

export default function () {
    const baseUrl = 'https://consejo-cronicas-production.up.railway.app';

    const response = http.get(`${baseUrl}/login`);

    check(response, {
        'pagina de login responde': (r) => r.status === 200,
    });
}