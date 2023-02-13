<?php

namespace Wheelpros\CatalogExtended\Model;

use Exception;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem\Io\File;
use Psr\Log\LoggerInterface;
use Wheelpros\CatalogExtended\Api\Data\ProductImageInterface;
use Wheelpros\CatalogExtended\Api\Data\StatusInterface;
use Wheelpros\CatalogExtended\Api\Data\StatusInterfaceFactory;
use Wheelpros\CatalogExtended\Api\ProductImageManagementInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\Registry;

class ProductImageManagement implements ProductImageManagementInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;
    /**
     * @var DirectoryList
     */
    private DirectoryList $directoryList;
    /**
     * @var File
     */
    private File $file;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;
    /**
     * @var StatusInterfaceFactory
     */
    private StatusInterfaceFactory $statusInterfaceFactory;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var CategoryFactory
     */
    private $categoryFactory;

    /**
     * YourClass constructor.
     * @param Registry $registry
     * @param CategoryFactory $categoryFactory
     */

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param DirectoryList              $directoryList
     * @param File                       $file
     * @param LoggerInterface            $logger
     * @param StatusInterfaceFactory     $statusInterfaceFactory
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        DirectoryList              $directoryList,
        File                       $file,
        LoggerInterface            $logger,
        StatusInterfaceFactory     $statusInterfaceFactory,
        Registry $registry,
        CategoryFactory $categoryFactory
    ) {
        $this->productRepository = $productRepository;
        $this->directoryList = $directoryList;
        $this->file = $file;
        $this->logger = $logger;
        $this->statusInterfaceFactory = $statusInterfaceFactory;
        $this->registry = $registry;
        $this->categoryFactory = $categoryFactory;
    }

    /**
     * @inheritDoc
     */
    public function create(string $sku, array $images)
    {
        try {
            /** @var StatusInterface $status */
            $status = $this->statusInterfaceFactory->create();
            $product = $this->productRepository->get($sku);
            /** @var ProductImageInterface $productImage */
            foreach ($images as $productImage) {
                $this->uploadProductImage($product, $productImage);
            }
            $status->setError(false);
            $status->setMessage(__('Successfully saved product images'));
        } catch (NoSuchEntityException $e) {
            $status->setError(true);
            $status->setMessage(__('Product with %1 doesn\'t exist', $sku));
        }

        return $status;
    }

    /**
     * Upload product image
     *
     * @param Product               $product
     * @param ProductImageInterface $productImage
     * @return void
     */
    private function uploadProductImage(Product $product, ProductImageInterface $productImage)
    {
        try {
            list($tempFilePath, $result) = $this->uploadImageToTemp($productImage->getMediaUri());
            if ($result) {
                $product->addImageToMediaGallery($tempFilePath, $productImage->getMediaType(), true, false);
                $this->productRepository->save($product);
            }
        } catch (Exception $e) {
            $this->logger->error('Error while uploading product image from API. ERROR:' . $e->getMessage());
        }
    }

    /**
     * @param $imagePath
     * @return array
     * @throws Exception
     */
    private function uploadImageToTemp($imagePath): array
    {
        /** @var string $tmpDir */
        $tmpDir = $this->getMediaDirTmpDir();
        /** create folder if it is not exists */
        $this->file->checkAndCreateFolder($tmpDir);
        /** @var string $newFileName */
        $newFileName = $tmpDir . baseName($imagePath);
        /** read file from URL and copy it to the new destination */
        $result = $this->file->read($imagePath, $newFileName);
        return array($newFileName, $result);
    }

    /**
     * Media directory name for the temporary file storage
     * pub/media/tmp
     *
     * @return string
     */
    protected function getMediaDirTmpDir()
    {
        return $this->directoryList->getPath(DirectoryList::MEDIA) . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR;
    }
    public function getCurrentCategoryName()
    {
        $category = $this->registry->registry('current_category');
        if ($category) {
            echo $category->getName();
        }
    }
}
