import { ConfigurationInterface } from './Interfaces/ConfigurationInterface';

export class Configuration implements ConfigurationInterface
{
    private apiEntrypoint: string;

    private authenticated: boolean;

    /**
     * @param {string} apiEntryPoint
     * @param {boolean} authenticated
     */
    constructor(apiEntryPoint: string, authenticated: boolean) {
        this.apiEntrypoint = apiEntryPoint;
        this.authenticated = authenticated;
    }

    /**
     * @returns {string}
     */
    getApiEntryPoint() : string {
        return this.apiEntrypoint;
    }

    /**
     * @returns {boolean}
     */
    getAuthenticated(): boolean {
        return this.authenticated;
    }
}
