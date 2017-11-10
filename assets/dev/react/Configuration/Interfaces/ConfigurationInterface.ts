export interface ConfigurationInterface {

    /**
     * @returns {string}
     */
    getApiEntryPoint(): string;

    /**
     * @returns {boolean}
     */
    getAuthenticated(): boolean;
}
