export default function useAttachment() {
    const isImage = (attachment) => {
        let mime = attachment.mime || attachment.type;
        mime = mime.split("/")
        return mime[0].toLowerCase() === 'image'
    }

    const isVideo = (attachment) => {
        let mime = attachment.mime || attachment.type;
        mime = mime.split("/")
        return mime[0].toLowerCase() === 'video'
    }

    const isAudio = (attachment) => {
        let mime = attachment.mime || attachment.type;
        mime = mime.split("/")
        return mime[0].toLowerCase() === 'audio'
    }

    const isPdf = (attachment) => {
        let mime = attachment.mime || attachment.type;
        return mime === 'application/pdf'
    }

    const isPreviewable = (attachment) => {
        return (
            isImage(attachment) ||
            isVideo(attachment) ||
            isAudio(attachment) ||
            isPdf(attachment)
        )
    }

    const formatBytes = (bytes, decimals = 2) => {
        if (bytes === 0) return "0 Bytes"

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals
        const sizes = ["Bytes", "KB", "MB", "GB"]

        let i = 0
        let size = bytes
        while (size >= k) {
            size /= k
            i++
        }

        return parseFloat(size.toFixed(dm)) + " " + sizes[i]
    }

    return{
        isImage,
        isVideo,
        isAudio,
        isPdf,
        isPreviewable,
        formatBytes
    }
}
