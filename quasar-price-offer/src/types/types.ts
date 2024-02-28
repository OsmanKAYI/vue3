interface OfferType {
  id: number;
  date: string;
  firm: string;
  itemCount: number;
  total: number;
  // Add other properties as needed
}

interface ItemColumnsType {
  name: 'picture' | 'unit' | 'total' | string; // Define the specific types for column.name
  required?: boolean;
  label: string;
  align: 'left' | 'center' | 'right';
  field: (row: itemRowsType) => string | number;
  format?: (val: string) => string;
  sortable?: boolean;
  style?: string;
  sort?: (
    a: string,
    b: string,
    rowA: itemRowsType,
    rowB: itemRowsType
  ) => number;
}

interface itemRowsType {
  itemId: number;
  sortOrder: number;
  productName: string;
  quantity: number;
  unit: string;
  unitPrice: number;
  total: number;
  picture: string;
}

export type { OfferType, ItemColumnsType, itemRowsType };
