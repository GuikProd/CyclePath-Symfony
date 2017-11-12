import { ConfigurationInterface } from './Interfaces/ConfigurationInterface';

export class Configuration implements ConfigurationInterface
{
    private apiEntrypoint: string;

    /**
     * @param {string} apiEntryPoint
     */
    constructor(apiEntryPoint: string) {
        this.apiEntrypoint = apiEntryPoint;
    }

    /**
     * @returns {string}
     */
    getApiEntryPoint() : string {
        return this.apiEntrypoint;
    }
}
