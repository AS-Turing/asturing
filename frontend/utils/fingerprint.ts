import FingerprintJS from "@fingerprintjs/fingerprintjs";

export default async function getFigerprint(): Promise<string> {
    const fp = await FingerprintJS.load()
    const result = await fp.get()
    const fingerprint = result.visitorId
    if (!fingerprint) return 'no match'

    return fingerprint

}
